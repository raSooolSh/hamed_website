@foreach ($ticket->messages as $message )
<div class="col-11 col-md-9 text-white p-3 mb-3 rounded rounded-3 {{ $message->is_owner ? 'bg-warning align-self-end' : 'bg-success align-self-start' }}">
    {{ $message->message }}
</div>
@endforeach