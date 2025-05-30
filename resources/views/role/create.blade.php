{{Form::open(array('url'=>'roles','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))}}
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-staff-tab" data-bs-toggle="pill" href="#staff" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Staff')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-document-tab" data-bs-toggle="pill" href="#document" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Document')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-pmpp-tab" data-bs-toggle="pill" href="#pmpp" role="tab" aria-controls="pills-home" aria-selected="true">{{__('PM/PP')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-supply_chain-tab" data-bs-toggle="pill" href="#supply_chain" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Supply Chain')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-bi-tab" data-bs-toggle="pill" href="#bi" role="tab" aria-controls="pills-home" aria-selected="true">{{__('BI')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-servicom-tab" data-bs-toggle="pill" href="#servicom" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Servicom')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-zoom-tab" data-bs-toggle="pill" href="#zoom" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Zoom')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-procurement-tab" data-bs-toggle="pill" href="#procurement" role="tab" aria-controls="pills-home" aria-selected="true">{{__('e-Procurement')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-mrm-tab" data-bs-toggle="pill" href="#mrm" role="tab" aria-controls="pills-home" aria-selected="true">{{__('MRM')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-inventory-tab" data-bs-toggle="pill" href="#inventory" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Inventory')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-internal-tab" data-bs-toggle="pill" href="#internal" role="tab" aria-controls="pills-home" aria-selected="true">{{__('IP')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-risk-tab" data-bs-toggle="pill" href="#risk" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Risk-M')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-crm-tab" data-bs-toggle="pill" href="#crm" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('CRM')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="pills-hrmpermission-tab" data-bs-toggle="pill" href="#hrmpermission" role="tab" aria-controls="pills-contact" aria-selected="false">{{__('HRM')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="pills-contact" aria-selected="false">{{__('Bursary')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-pos-tab" data-bs-toggle="pill" href="#pos" role="tab" aria-controls="pills-contact" aria-selected="false">{{__('POS')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-files-tab" data-bs-toggle="pill" href="#files" role="tab" aria-controls="pills-contact" aria-selected="false">{{__('Files')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['New files','files','this month','older files', 'starred', 'shared', 'recovery'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view file',(array) $permissions))
                                                        @if($key = array_search('view file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit file',(array) $permissions))
                                                        @if($key = array_search('edit file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create file',(array) $permissions))
                                                        @if($key = array_search('create file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('share file',(array) $permissions))
                                                        @if($key = array_search('share file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Share',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['memo/letters','files','document setup'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view file',(array) $permissions))
                                                        @if($key = array_search('view file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit file',(array) $permissions))
                                                        @if($key = array_search('edit file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create file',(array) $permissions))
                                                        @if($key = array_search('create file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('share file',(array) $permissions))
                                                        @if($key = array_search('share file',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Share',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pmpp" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['projects','tasks','timesheet', 'task calendar', 'project report', 'project system setup'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view project',(array) $permissions))
                                                        @if($key = array_search('view project',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit project',(array) $permissions))
                                                        @if($key = array_search('edit project',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create project',(array) $permissions))
                                                        @if($key = array_search('create project',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage project',(array) $permissions))
                                                        @if($key = array_search('manage project',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="supply_chain" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['stocks/assets','location','purchase', 'task calendar', 'add assets', 'stock/inventory', 'transfer', 'print barcode', 'print settings'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view stock',(array) $permissions))
                                                        @if($key = array_search('view stock',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit stock',(array) $permissions))
                                                        @if($key = array_search('edit stock',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create stock',(array) $permissions))
                                                        @if($key = array_search('create stock',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage stock',(array) $permissions))
                                                        @if($key = array_search('manage stock',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('add stock',(array) $permissions))
                                                        @if($key = array_search('add stock',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['assets/inventory/stocks','location','purchase', 'task calendar', 'add assets', 'stock/inventory', 'transfer', 'print barcode', 'print settings'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('move '.$module,(array) $permissions))
                                                        @if($key = array_search('move '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income '.$module,(array) $permissions))
                                                        @if($key = array_search('income '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                        @if($key = array_search('expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                        @if($key = array_search('tax '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                        @if($key = array_search('bill '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bi" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['analytics'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view bi',(array) $permissions))
                                                        @if($key = array_search('view bi',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit bi',(array) $permissions))
                                                        @if($key = array_search('edit bi',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create bi',(array) $permissions))
                                                        @if($key = array_search('create bi',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage bi',(array) $permissions))
                                                        @if($key = array_search('manage bi',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mrm" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['overview', 'reports', 'leads', 'deals', 'mrm system setup'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Document related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view mrm',(array) $permissions))
                                                        @if($key = array_search('view mrm',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit mrm',(array) $permissions))
                                                        @if($key = array_search('edit mrm',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create mrm',(array) $permissions))
                                                        @if($key = array_search('create mrm',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage mrm_system',(array) $permissions))
                                                        @if($key = array_search('manage mrm_system',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('view mrm_report',(array) $permissions))
                                                        @if($key = array_search('view mrm_report',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('send mrm_report',(array) $permissions))
                                                        @if($key = array_search('send mrm_report',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('view mrm_overview',(array) $permissions))
                                                        @if($key = array_search('view mrm_overview',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="staff" role="tabpanel" aria-labelledby="pills-home-tab">
                    @php
                        $modules=['user','role','registrar','product & service','constant unit','constant tax','constant category','company settings'];
                       if(\Auth::user()->type == 'super admin'){
                           $modules[] = 'permission';
                       }
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign General Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input" name="staff_checkall"  id="staff_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck staff_checkall"  data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}" ></td>
                                            <td><label class="ischeck staff_checkall" data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '',  str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('move '.$module,(array) $permissions))
                                                        @if($key = array_search('move '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif


                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income '.$module,(array) $permissions))
                                                        @if($key = array_search('income '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                        @if($key = array_search('expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                        @if($key = array_search('tax '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                        @if($key = array_search('bill '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck staff_checkall isscheck_'.str_replace(' ', '', str_replace('&', '', $module)),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="servicom" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['Tickets'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign CRM related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view servicom',(array) $permissions))
                                                        @if($key = array_search('view servicom',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit servicom',(array) $permissions))
                                                        @if($key = array_search('edit servicom',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('approve servicom',(array) $permissions))
                                                        @if($key = array_search('approve servicom',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Approve',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create servicom',(array) $permissions))
                                                        @if($key = array_search('create servicom',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage servicom',(array) $permissions))
                                                        @if($key = array_search('manage servicom',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="zoom" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['meetings'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign CRM related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view meeting',(array) $permissions))
                                                        @if($key = array_search('view meeting',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit meeting',(array) $permissions))
                                                        @if($key = array_search('edit meeting',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('approve meeting',(array) $permissions))
                                                        @if($key = array_search('approve meeting',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Approve',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create meeting',(array) $permissions))
                                                        @if($key = array_search('create meeting',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage meeting',(array) $permissions))
                                                        @if($key = array_search('manage meeting',$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="crm" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @php
                        $modules=['crm dashboard','lead','pipeline','lead stage','source','label','deal','stage','task','form builder','form response','contract','contract type'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign CRM related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="crm_heckall"  id="crm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck crm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck crm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('move '.$module,(array) $permissions))
                                                        @if($key = array_search('move '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income '.$module,(array) $permissions))
                                                        @if($key = array_search('income '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                        @if($key = array_search('expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                        @if($key = array_search('tax '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                        @if($key = array_search('bill '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck crm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="hrmpermission" role="tabpanel" aria-labelledby="pills-contact-tab">
                    @php
                        $modules=['hrm dashboard','payroll','reports/analytics','performance management','HRM system setup','employee info management','training setup','recruitment and onboarding','HR/employee benefits','employee assests setup','document setup','company policy'];
                    @endphp

                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign HRM related Permission to Roles')}}
                                </h6>

                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input align-middle custom_align_middle" name="hrm_checkall"  id="hrm_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input align-middle ischeck hrm_checkall"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck hrm_checkall" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">

                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    <!-- @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('move '.$module,(array) $permissions))
                                                        @if($key = array_search('move '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif


                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income '.$module,(array) $permissions))
                                                        @if($key = array_search('income '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                        @if($key = array_search('expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                        @if($key = array_search('tax '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                        @if($key = array_search('bill '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck hrm_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="pills-contact-tab">
                    @php
                        $modules=['overview','reports','banking','voucher','purchases','double entry','budget planner','financial goal','accounting setup','print settings'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign Bursary related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="account_checkall"  id="account_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('move '.$module,(array) $permissions))
                                                        @if($key = array_search('move '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income '.$module,(array) $permissions))
                                                        @if($key = array_search('income '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('expense '.$module,(array) $permissions))
                                                        @if($key = array_search('expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('income vs expense '.$module,(array) $permissions))
                                                        @if($key = array_search('income vs expense '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Income VS Expense',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('loss & profit '.$module,(array) $permissions))
                                                        @if($key = array_search('loss & profit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Loss & Profit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('tax '.$module,(array) $permissions))
                                                        @if($key = array_search('tax '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Tax',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('invoice '.$module,(array) $permissions))
                                                        @if($key = array_search('invoice '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Invoice',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('bill '.$module,(array) $permissions))
                                                        @if($key = array_search('bill '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Bill',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('duplicate '.$module,(array) $permissions))
                                                        @if($key = array_search('duplicate '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Duplicate',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('balance sheet '.$module,(array) $permissions))
                                                        @if($key = array_search('balance sheet '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Balance Sheet',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('ledger '.$module,(array) $permissions))
                                                        @if($key = array_search('ledger '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Ledger',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('trial balance '.$module,(array) $permissions))
                                                        @if($key = array_search('trial balance '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck account_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Trial Balance',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pos" role="tabpanel" aria-labelledby="pills-contact-tab">
                    @php
                        $modules=['warehouse','purchase','pos','barcode'];
                    @endphp
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(!empty($permissions))
                                <h6 class="my-3">{{__('Assign POS related Permission to Roles')}}</h6>
                                <table class="table table-striped mb-0" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input custom_align_middle" name="pos_checkall"  id="pos_checkall" >
                                        </th>
                                        <th>{{__('Module')}} </th>
                                        <th>{{__('Permissions')}} </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($modules as $module)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input ischeck"  data-id="{{str_replace(' ', '', $module)}}" ></td>
                                            <td><label class="ischeck" data-id="{{str_replace(' ', '', $module)}}">{{ ucfirst($module) }}</label></td>
                                            <td>
                                                <div class="row ">
                                                    @if(in_array('view '.$module,(array) $permissions))
                                                        @if($key = array_search('view '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'View',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('add '.$module,(array) $permissions))
                                                        @if($key = array_search('add '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Add',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('manage '.$module,(array) $permissions))
                                                        @if($key = array_search('manage '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('create '.$module,(array) $permissions))
                                                        @if($key = array_search('create '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('edit '.$module,(array) $permissions))
                                                        @if($key = array_search('edit '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete '.$module,(array) $permissions))
                                                        @if($key = array_search('delete '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('show '.$module,(array) $permissions))
                                                        @if($key = array_search('show '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif


                                                    @if(in_array('send '.$module,(array) $permissions))
                                                        @if($key = array_search('send '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Send',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if(in_array('create payment '.$module,(array) $permissions))
                                                        @if($key = array_search('create payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Create Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if(in_array('delete payment '.$module,(array) $permissions))
                                                        @if($key = array_search('delete payment '.$module,$permissions))
                                                            <div class="col-md-3 custom-control custom-checkbox">
                                                                {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck pos_checkall isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                                {{Form::label('permission'.$key,'Delete Payment',['class'=>'custom-control-label'])}}<br>
                                                            </div>
                                                        @endif
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

<script>
    $(document).ready(function () {
        $("#staff_checkall").click(function(){
            $('.staff_checkall').not(this).prop('checked', this.checked);
        });
        $("#crm_checkall").click(function(){
            $('.crm_checkall').not(this).prop('checked', this.checked);
        });
        $("#project_checkall").click(function(){
            $('.project_checkall').not(this).prop('checked', this.checked);
        });
        $("#hrm_checkall").click(function(){
            $('.hrm_checkall').not(this).prop('checked', this.checked);
        });
        $("#account_checkall").click(function(){
            $('.account_checkall').not(this).prop('checked', this.checked);
        });
        $("#pos_checkall").click(function(){
            $('.pos_checkall').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function(){
            var ischeck = $(this).data('id');
            $('.isscheck_'+ ischeck).prop('checked', this.checked);
        });
    });
</script>
