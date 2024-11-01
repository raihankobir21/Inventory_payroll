<!-- @extends('layouts.app')

@section('content')
    <h1>Edit Off Days</h1>
    <form action="{{ route('off-days.update', $offDay->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="month_year">Month and Year</label>
            <input type="month" name="month_year" class="form-control" id="month_year" value="{{ $offDay->month_year }}" required>
        </div>

        <div class="form-group">
            <label for="calendar">Select Off Days</label>
            <div id="calendar"></div>
            <input type="hidden" name="off_days" id="off_days">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/fullcalendar.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet"/>

    <script>
        $(document).ready(function() {
            let selectedDates = JSON.parse($('#off_days').val()) || [];

            $('#calendar').fullCalendar({
                selectable: true,
                select: function(start, end) {
                    let date = start.startStr;
                    if (!selectedDates.includes(date)) {
                        selectedDates.push(date);
                        $(this).fullCalendar('renderEvent', {
                            title: 'Off Day',
                            start: date,
                            allDay: true,
                            backgroundColor: 'red'
                        });
                    }
                    $('#off_days').val(JSON.stringify(selectedDates));
                    $(this).fullCalendar('unselect');
                },
                editable: true,
                events: selectedDates.map(date => ({
                    title: 'Off Day',
                    start: date,
                    allDay: true,
                    backgroundColor: 'red'
                }))
            });
        });
    </script>
@endsection -->
