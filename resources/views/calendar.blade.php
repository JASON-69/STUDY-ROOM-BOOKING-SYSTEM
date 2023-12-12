@extends('layouts.card')

@section('card-name')
    {{ __('Calendar') }}
@endsection

@section('card-content')
    <div class="row">
        <div id="calendar"></div>
    </div>
    <hr>
    <div class="d-flex justify-content-end gap-4">
        @if (auth()->user()->is_admin)
            <div>
                <span class="px-2 bg-success rounded-circle"></span>
                <label class="px-2">
                    Approved
                </label>
            </div>
            <div>
                <span class="px-2 bg-primary rounded-circle"></span>
                <label class="px-2">
                    Booked
                </label>
            </div>
            <div>
                <span class="px-2 bg-danger rounded-circle"></span>
                <label class="px-2">
                    Rejected
                </label>
            </div>
        @endif
        @if (!auth()->user()->is_admin)
            <div>
                <span class="px-2 bg-success rounded-circle"></span>
                <label class="px-2">
                    Approved
                </label>
            </div>
            <div>
                <span class="px-2 bg-primary rounded-circle"></span>
                <label class="px-2">
                    Pending
                </label>
            </div>
            <div>
                <span class="px-2 bg-danger rounded-circle"></span>
                <label class="px-2">
                    Rejected
                </label>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script type="module">
        var $el = $('#calendar');
        $(document).ready(function() {
            $el.zabuto_calendar({
                classname: 'table table-bordered clickable',
                ajax: {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('calendar.show') }}',
                },
            });
        });
        $el.on('zabuto:calendar:day', function(e) {
            if (e.target.querySelector('span') != null) {
                const gotoModal = document.querySelector('#gotoModal');
                
                var bsGotoModal = new bootstrap.Modal(gotoModal);
                bsGotoModal.show();

                var bookingId = JSON.parse(e.target.querySelector('span').dataset.bsId);
                var bookerName = JSON.parse(e.target.querySelector('span').dataset.bsName);
                var bookingDate = JSON.parse(e.target.querySelector('span').dataset.bsDate);
                var bookingTime = JSON.parse(e.target.querySelector('span').dataset.bsTime);
                var bookingStatus = JSON.parse(e.target.querySelector('span').dataset.bsStatus);

                var bookingInput = document.querySelector('#booking-input');
                
                bookingInput.innerHTML = '';
                
                bookingInput.addEventListener('change', function() {
                    var index = bookingId.indexOf(parseInt(this.value));
                    document.querySelector('#date-input').value = bookingDate[index];
                    document.querySelector('#time-input').value = bookingTime[index];
                    document.querySelector('#status-input').value = bookingStatus[index];
                });

                // Add options to select element
                for (var i = 0; i < bookingId.length; i++) {
                    var option = document.createElement('option');
                    option.value = bookingId[i];
                    option.text = bookerName[i];
                    bookingInput.appendChild(option);
                    bookingInput.dispatchEvent(new Event('change'));
                }

                var gotoButton = document.querySelector('#gotoButton');

                gotoButton.addEventListener('click', function() {
                    location.href = '{{ route('application.show', '') }}/' + bookingInput.value;
                });
                
            } else {
                location.href = '{{ route('application') }}/' + e.date.toDateString();
            }
        });
    </script>
@endsection

@section('modals')
    <div class="modal modal-lg fade" id="gotoModal" tabindex="-1" aria-labelledby="gotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gotoModalLabel">Go to Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 row-cols-1 row-cols-sm-2">
                            <label for="booking-id" class="col-form-label">Booked by:</label>
                            <div class="col">
                                <select class="form-select" name="booking-id" id="booking-input">
                                    <option selected>Open this select menu</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-1 row-cols-sm-2 row-gap-2">
                            <label for="date" class="col-form-label">Date:</label>
                            <div class="col">
                                <input type="text" id="date-input" class="form-control" disabled>
                            </div>
                            <label for="time">Time: </label>
                            <div class="col">
                                <input type="text" id="time-input" class="form-control" disabled>
                            </div>
                            <label for="time">Status: </label>
                            <div class="col">
                                <input type="text" id="status-input" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="gotoButton">Go To Booking Page</button>
                </div>
            </div>
        </div>
    </div>
@endsection