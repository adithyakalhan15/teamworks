@if (session()->has('message'))

<br>
<br>

<div class="msg-cont">
    <div class="msg-box">
        <span>{{ session('message') }}</span>
    </div>
</div>

{{-- errors --}}
@if ($errors->any())

@foreach ($errors->all() as $error)
<div class="msg-cont">
    <div class="msg-box">
        <span>{{ $error }}</span>
    </div>
</div>
@endforeach
@endif
<style>
    .msg-cont{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;

    }

    .msg-box{
        background-color: #d8d8d8;
        padding: 1rem 2.5rem; 
        border-radius: 4px;
        border: 1px solid #bcbcbc;
        width: 400px;
    }
</style>
@endif
