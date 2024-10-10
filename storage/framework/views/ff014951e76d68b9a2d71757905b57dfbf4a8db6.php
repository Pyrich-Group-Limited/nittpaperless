<?php echo e(Form::model($productService, array('route' => array('productservice.update', $productService->id), 'method' => 'PUT','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $settings = \App\Models\Utility::settings();
    ?>
    <?php if($settings['ai_chatgpt_enable'] == 'on'): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['productservice'])); ?>"
               data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sn', __('SN'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('sn',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('asset_identification_code', __('Asset Identification Code'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('asset_identification_code', null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('asset_type', __('Asset Type'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('asset_type', null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('location', __('Location'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('location',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('no_of_unit', __('No of Unit'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('no_of_unit', null, array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('model_number', __('Model Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('model_number',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('year_of_manufacture', __('Year Of Manufacture'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('year_of_manufacture',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('serial_no_other', __('Serial No/Other'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('serial_no_other',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('date_of_purchase', __('Date Of Purchase'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('date_of_purchase',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('initial_cost', __('Initial Cost'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('initial_codst',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('measure_improvement_of_asset', __('Measure Improvement Of Asset'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('measure_improvement_of_asset',null, array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
     <!---   <div class="form-group  col-md-6">
            <?php echo e(Form::label('tax_id', __('Tax'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('tax_id[]', $tax,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'=>''))); ?>

        </div>

        <div class="form-group  col-md-6">
            <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('category_id', $category,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('unit_id', __('Unit'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('unit_id', $unit,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>   ---->

        <div class="col-md-6 form-group">
            <?php echo e(Form::label('pro_image',__('Product Image'),['class'=>'form-label'])); ?>

            <div class="choose-file ">
                <label for="pro_image" class="form-label">
                    <input type="file" class="form-control" name="pro_image" id="pro_image" data-filename="pro_image_create">
                    <img id="image"  class="mt-3" width="100" src="<?php if($productService->pro_image): ?><?php echo e(asset(Storage::url('uploads/pro_image/'.$productService->pro_image))); ?><?php else: ?><?php echo e(asset(Storage::url('uploads/pro_image/user-2_1654779769.jpg'))); ?><?php endif; ?>" />
                </label>
            </div>
        </div>



    <!---    <div class="col-md-6">
            <div class="form-group">
                <label class="d-block form-label"><?php echo e(__('Type')); ?></label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type" id="customRadio5" name="type" value="product" <?php if($productService->type=='product'): ?> checked <?php endif; ?> >
                            <label class="custom-control-label form-label" for="customRadio5"><?php echo e(__('Product')); ?></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type" id="customRadio6" name="type" value="service" <?php if($productService->type=='service'): ?> checked <?php endif; ?> >
                            <label class="custom-control-label form-label" for="customRadio6"><?php echo e(__('Service')); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group col-md-6 quantity <?php echo e($productService->type=='service' ? 'd-none':''); ?>">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('quantity',null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>  ----->
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('asset_description', __('Asset Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('asset_description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>


    </div>
    <?php if(!$customFields->isEmpty()): ?>
        <div class="col-md-6">
            <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<script>
    document.getElementById('pro_image').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }

    //hide & show quantity

    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });
</script>

<?php /**PATH C:\xampp\htdocs\ENIT\nittpaperless\resources\views/productservice/edit.blade.php ENDPATH**/ ?>