@props(['status'])

@php
    switch ($status) {
        case 'pending':
            $progress = 50;
            break;
        case 'completed':
            $progress = 100;
            break;
        default:
            $progress = 0;
            break;
    }
@endphp

<div class="mx-4">
    <div class="progress" id="progress1">
        <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
            style="width: {{ $progress }}%;">
        </div>
    </div>
    <div class="row step">
        <div id="div1" class="col-md-4">
            <p>Start</p>
        </div>
        <div class="col-md-4 text-center">
            <p>Pending</p>
        </div>
        <div class="col-md-4 text-end">
            <p>Completed</p>
        </div>
    </div>
</div>

{{-- <script type="text/javascript">
    function resetActive(event, percent) {
        const progressBar = document.querySelector("#progress-bar");
        progressBar.style.width = percent + "%";
        progressBar.setAttribute("aria-valuenow", percent);

        console.log(percent)
    }
</script> --}}
