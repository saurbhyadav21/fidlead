@extends('layouts.app')

@section('content')
    <style>
        #upload-progress-bar,
        #processing-progress-bar {
            border: 1px solid #000;
            border-radius: 5px;
            margin-top: 10px;
        }

        #upload-progress,
        #processing-progress {
            height: 20px;
            border-radius: 5px;
        }
    </style>
    {{-- Global HTML which used anywhere --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-7">
                        <div class="container mt-5">
                            <h2>Upload File (Upload only CSV File)</h2>
                            <form id="uploadForm" method="POST" enctype="multipart/form-data" action="{{ route('upload') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Choose file:</label>
                                    <input type="file" class="form-control-file" id="file" name="file" required accept=".csv">
                                </div>
                                <div class="form-group">
                                    <label for="data_type">Data Type:</label>
                                    <select class="form-control" id="data_type" name="data_type" required>
                                        <option value="buyer">Buyer</option>
                                        <option value="supplier">Supplier</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>

                            <!-- Progress bar for file upload -->
                            <div class="progress mt-4" style="height: 30px;" id="test">
                                <div id="fileUploadProgressBar" class="progress-bar bg-success" role="progressbar"
                                    style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                </div>
                            </div>

                            <!-- Timer and Message -->
                            <div id="timerMessage" class="mt-4"></div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script>
    $(document).ready(function () {
        $("#test").hide();

        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            $("#test").show();
            startTimer(1200, function () {
                $('#timerMessage').text('Time is up!');
            });

            let fileInput = document.querySelector('input[type="file"]');
            let file = fileInput.files[0];

            Papa.parse(file, {
                complete: function(results) {
                    let rows = results.data;
                    let invalidRow = -1;
                    let invalidColumn = -1;
                    let invalidValue = "";

                    for (let i = 0; i < rows.length; i++) {
                        let row = rows[i];
                        for (let j = 0; j < row.length; j++) {
                            let cell = row[j];
                            if (cell.includes(',') || cell.includes(';')) {
                                invalidRow = i + 1;
                                invalidColumn = j + 1;
                                invalidValue = cell;
                                break;
                            }
                        }
                        if (invalidRow !== -1) {
                            break;
                        }
                    }

                    if (invalidRow !== -1) {
                        alert('Invalid character found in row ' + invalidRow + ', column ' + invalidColumn + ': "' + invalidValue + '". Please correct the CSV file and try again.');
                        location.reload();
                    } else {
                        let formData = new FormData($('#uploadForm')[0]);
                        $.ajax({
                            url: $('#uploadForm').attr('action'),
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            xhr: function () {
                                let xhr = new window.XMLHttpRequest();

                                xhr.upload.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                        $('#fileUploadProgressBar').css('width', percentComplete + '%').text(percentComplete + '%');
                                    }
                                }, false);

                                return xhr;
                            },
                            success: function (response) {
                                console.log(response.message);

                                if (response.success) {
                                    // Show alert with the row count
                                    alert('File processed successfully. Rows inserted/updated: ' + response.row_count);
                                }
                            },
                            error: function (xhr) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.message) {
                                    alert('Error: ' + response.message);
                                }
                                console.error(response.message);
                            }
                        });
                    }
                },
                error: function(error) {
                    console.error('Error parsing CSV file:', error.message);
                    alert('Failed to parse the CSV file.');
                }
            });
        });

    });

    function startTimer(duration, callback) {
        let timer = duration, minutes, seconds;
        const interval = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            $('#timerMessage').text('Time remaining To Upload : ' + minutes + ':' + seconds);

            if (--timer < 0) {
                clearInterval(interval);
                callback();
            }
        }, 1000);
    }
</script>
