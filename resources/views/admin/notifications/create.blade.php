@extends('layouts.app')

@section('title', 'Create Notification')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Notification</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-7">
                    <div class="container">
                        <h2>Create Notification</h2>
                        <form action="{{ url('/admin/notifications/store') }}" method="POST">
                            @csrf
                             <!-- Checkbox to select All Users (checked by default) -->
                            <div class="form-group">
                                <label for="send_all">Send to All Users</label>
                                <input type="checkbox" name="send_all" id="send_all" class="form-control" value="1" checked onclick="toggleUserDropdown(this)">
                            </div>

                            <!-- Multi-select dropdown for selecting users -->
                            <div class="form-group" id="user_select_group" style="display: none;">
                                <label for="user_ids">Select Users:</label>
                                <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Hold down "Ctrl" (or "Cmd") to select multiple users.</small>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<!-- Include Select2 JS and CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for the user select dropdown
        $('#user_ids').select2({
            placeholder: "Select Users",  // Placeholder text when no users are selected
            allowClear: true  // Allow clearing of selection
        });
    });

    // Function to toggle user selection dropdown
    function toggleUserDropdown(checkbox) {
        const userSelectGroup = document.getElementById('user_select_group');
        if (checkbox.checked) {
            userSelectGroup.style.display = 'none'; // Hide dropdown if 'Send to All Users' is selected
        } else {
            userSelectGroup.style.display = 'block'; // Show dropdown if 'Send to All Users' is not selected
        }
    }
</script>

@endsection
