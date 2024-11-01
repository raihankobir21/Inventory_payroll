@extends('layouts.app')
<style>
	.fc-button-group{ display:none !important }
	.fc-button { display:none !important }
</style>
@section('content')
    <h1>Select Leave Days</h1>
    <form action="{{ route('leave-days.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">--Select User--</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
      

        <div class="form-group">
            <label for="month_year">Month and Year</label>
            <input type="month" name="month_year" class="form-control" id="month_year" required>
        </div>

        <div class="form-group">
            <label for="calendar">Select Leave Days</label>
            <div id="calendar"></div>
            <input type="hidden" name="leave_days" id="leave_days">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Include necessary scripts and styles for FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.0.0/index.global.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.0.0/main.min.css" rel="stylesheet"/>

    <script>
        $(document).ready(function() {
            let selectedDates = [];

            function initializeCalendar(year, month) {
                let calendarEl = document.getElementById('calendar');

                // Destroy any existing calendar instance
                if (calendarEl._fc) {
                    calendarEl._fc.destroy();
                }

                // Initialize FullCalendar
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    selectable: true,
                    select: function(info) {
                        let date = info.startStr;
                        if (!selectedDates.includes(date)) {
                            selectedDates.push(date);
                            calendar.addEvent({
                                title: 'Leave Day',
                                start: date,
                                allDay: true,
                                backgroundColor: 'green'
                            });
                        }
                        $('#leave_days').val(JSON.stringify(selectedDates));
                        calendar.unselect();
                    },
                    editable: true,
                    events: selectedDates.map(date => ({
                        title: 'Leave Day',
                        start: date,
                        allDay: true,
                        backgroundColor: 'green'
                    }))
                });

                calendar.render();
                calendar.gotoDate(`${year}-${month}-01`);
            }

            $('#month_year').on('change', function() {
                let monthYear = $(this).val();
                if (monthYear) {
                    let [year, month] = monthYear.split('-');
                    initializeCalendar(year, month);
                }
            });

            // Initialize the calendar with the current month and year if available
            let initialMonthYear = $('#month_year').val();
            if (initialMonthYear) {
                let [year, month] = initialMonthYear.split('-');
                initializeCalendar(year, month);
            }
        });
    </script>
@endsection
