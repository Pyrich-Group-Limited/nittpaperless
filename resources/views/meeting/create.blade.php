{{-- {{Form::open(array('url'=>'meeting','method'=>'post'))}}
<div class="modal-body">
    @php
        $settings = \App\Models\Utility::settings();
    @endphp
    @if($settings['ai_chatgpt_enable'] == 'on')
        <div class="text-end">
            <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['meeting']) }}"
               data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
                <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
            </a>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch_id',__('Branch'),['class'=>'form-label'])}}
                <select class="form-control select" name="branch_id" id="branch_id" placeholder="Select Branch">
                    <option value="">{{__('Select Branch')}}</option>
                    <option value="0">{{__('All Branch')}}</option>
                    @foreach($branch as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" id="department_div">
                {{Form::label('department_id',__('Department'),['class'=>'form-label'])}}
                <select class="form-control select" name="department_id[]" id="department_id" placeholder="Select Department" >
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" id="employee_div">
                {{Form::label('employee_id',__('Employee'),['class'=>'form-label'])}}
                <select class="form-control select" name="employee_id[]" id="employee_id" placeholder="Select Employee" >
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Meeting Title'),['class'=>'form-label'])}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Meeting Title')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('date',__('Meeting Date'),['class'=>'form-label'])}}
                {{Form::date('date',null,array('class'=>'form-control '))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('time',__('Meeting Time'),['class'=>'form-label'])}}
                {{Form::time('time',null,array('class'=>'form-control timepicker'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('note',__('Meeting Note'),['class'=>'form-label'])}}
                {{Form::textarea('note',null,array('class'=>'form-control','placeholder'=>__('Enter Meeting Note')))}}
            </div>
        </div>
        @if(isset($settings['google_calendar_enable']) && $settings['google_calendar_enable'] == 'on')
            <div class="form-group col-md-6 ">
                {{Form::label('synchronize_type',__('Synchronize in Google Calendar ?'),array('class'=>'form-label')) }}
                <div class="form-switch">
                    <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow" value="google_calender">
                    <label class="form-check-label" for="switch-shadow"></label>
                </div>
            </div>
        @endif

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
</div>
{{Form::close()}} --}}

{{ Form::open(['url' => 'meeting', 'method' => 'post']) }}
<div class="modal-body">
    {{-- AI Generation --}}
    @php $settings = \App\Models\Utility::settings(); @endphp
    @if($settings['ai_chatgpt_enable'] == 'on')
        <div class="text-end mb-2">
            <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm"
               data-ajax-popup-over="true"
               data-url="{{ route('generate', ['meeting']) }}"
               data-bs-placement="top"
               data-title="{{ __('Generate content with AI') }}">
                <i class="fas fa-robot"></i> <span>{{ __('Generate with AI') }}</span>
            </a>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('department_id', __('Departments'), ['class' => 'form-label']) }}
                <select class="form-control select2" name="department_id[]" id="department_id" multiple>
                    <option value="0">{{ __('All Departments') }}</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('employee_id', __('Employees'), ['class' => 'form-label']) }}
                <select class="form-control select2" name="employee_id[]" id="employee_id" multiple>
                    <option value="0">{{ __('All Employees') }}</option>
                </select>
            </div>
        </div>
        

        {{-- Title --}}
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('title', __('Meeting Title'), ['class' => 'form-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Title')]) }}
            </div>
        </div>

        {{-- Date --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', __('Meeting Date'), ['class' => 'form-label']) }}
                {{ Form::date('date', null, ['class' => 'form-control']) }}
            </div>
        </div>

        {{-- Time --}}
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('time', __('Meeting Time'), ['class' => 'form-label']) }}
                {{ Form::time('time', null, ['class' => 'form-control']) }}
            </div>
        </div>

        {{-- Note --}}
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('note', __('Meeting Note'), ['class' => 'form-label']) }}
                {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Note')]) }}
            </div>
        </div>

        {{-- Google Calendar --}}
        @if(isset($settings['google_calendar_enable']) && $settings['google_calendar_enable'] == 'on')
            <div class="form-group col-md-6">
                {{ Form::label('synchronize_type', __('Synchronize in Google Calendar?'), ['class' => 'form-label']) }}
                <div class="form-switch">
                    <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" value="google_calender">
                    <label class="form-check-label" for="synchronize_type"></label>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>
{{ Form::close() }}

{{-- @push('script') --}}
<script>
    $('#department_id').on('change', function () {
        let departmentIds = $(this).val();

        $.ajax({
            url: '{{ route('meeting.getDepartmentEmployees') }}',
            type: 'GET',
            data: {
                department_ids: departmentIds
            },
            success: function (response) {
                console.log('Employees:', response.employees);

                let employeeSelect = $('#employee_id');
                employeeSelect.empty(); // Clear existing options

                employeeSelect.append(`<option value="0">All Employees</option>`);

                $.each(response.employees, function (id, name) {
                    employeeSelect.append(`<option value="${id}">${name}</option>`);
                });

                // If you're using Select2 or similar, reinitialize it
                if ($.fn.select2) {
                    employeeSelect.trigger('change.select2');
                }
            },
            error: function () {
                alert('Error fetching employees');
            }
        });
    });


</script>
{{-- @endpush --}}



