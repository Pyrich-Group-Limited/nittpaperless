@if(Session::has('errorfeedback'))
    <div class="example-alert">
        <div class="alert alert-danger alert-icon">
            <em class="icon ni ni-cross-circle"></em> <strong>Error</strong>! {{ Session::get('errorfeedback')}}.
        </div>
    </div>
@endif

@if(Session::has('feedback'))
<div class="example-alert">
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em> <strong>Success</strong>!  {{ Session::get('feedback')}}.
    </div>
</div>
@endif


