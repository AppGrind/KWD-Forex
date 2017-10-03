@foreach (session('flash_notification', collect())->toArray() as $message)

    @if($message['level'] == 'success')
        <script>
            // Display a success toast, with a title
            toastr.success(" {{ $message['message'] }} ", " {{ $message['title'] }} ")
        </script>

    @elseif($message['level'] == 'error')
        <script>
            // Display a success toast, with a title
            toastr.error(" {{ $message['message'] }} ", " {{ $message['title'] }} ")
        </script>

    @elseif($message['level'] == 'warning')
        <script>
            // Display a success toast, with a title
            toastr.warning(" {{ $message['message'] }} ", " {{ $message['title'] }} ")
        </script>

    @else
        <script>
            // Display a success toast, with a title
            toastr.info(" {{ $message['message'] }} ", " {{ $message['title'] }} ")
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
