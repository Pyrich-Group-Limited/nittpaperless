<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")"); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        <?php if($calenderTasks): ?>
            (function() {
                var etitle;
                var etype;
                var etypeclass;
                var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem: 'bootstrap',
                    initialDate: '<?php echo e($transdate); ?>',
                    slotDuration: '00:10:00',
                    navLinks: true,
                    droppable: true,
                    selectable: true,
                    selectMirror: true,
                    editable: true,
                    dayMaxEvents: true,
                    handleWindowResize: true,
                    events: <?php echo json_encode($calenderTasks); ?>,

                });
                calendar.render();
            })();
        <?php endif; ?>

        $(document).on('click', '.fc-day-grid-event', function(e) {
            if (!$(this).hasClass('deal')) {
                e.preventDefault();
                var event = $(this);
                var title = $(this).find('.fc-content .fc-title').html();
                var size = 'md';
                var url = $(this).attr('href');
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);

                $.ajax({
                    url: url,
                    success: function(data) {
                        $('#commonModal .modal-body').html(data);
                        $("#commonModal").modal('show');
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('error', data.error, 'error')
                    }
                });
            }
        });
    </script>
    <script>
        (function() {
            var chartBarOptions = {
                series: <?php echo json_encode($taskData['dataset']); ?>,


                chart: {
                    height: 250,
                    type: 'area',
                    // type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($taskData['label']); ?>,
                    title: {
                        text: "<?php echo e(__('Days')); ?>"
                    }
                },
                colors: ['#6fd944', '#883617', '#4e37b9', '#8f841b'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                // markers: {
                //     size: 4,
                //     colors: ['#3b6b1d', '#be7713' ,'#2037dc','#cbbb27'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: "<?php echo e(__('Amount')); ?>"
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
            arChart.render();
        })();



        (function() {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode(array_values($projectData)); ?>,
                colors: ["#bd9925", "#2f71bd", "#720d3a", "#ef4917"],
                labels: <?php echo json_encode($project_status); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#chart-doughnut"), options);
            chart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php

        $project_task_percentage = $project['project_task_percentage'];
        $label = '';
        if ($project_task_percentage <= 15) {
            $label = 'bg-danger';
        } elseif ($project_task_percentage > 15 && $project_task_percentage <= 33) {
            $label = 'bg-warning';
        } elseif ($project_task_percentage > 33 && $project_task_percentage <= 70) {
            $label = 'bg-primary';
        } else {
            $label = 'bg-success';
        }

        $project_percentage = $project['project_percentage'];
        $label1 = '';
        if ($project_percentage <= 15) {
            $label1 = 'bg-danger';
        } elseif ($project_percentage > 15 && $project_percentage <= 33) {
            $label1 = 'bg-warning';
        } elseif ($project_percentage > 33 && $project_percentage <= 70) {
            $label1 = 'bg-primary';
        } else {
            $label1 = 'bg-success';
        }

        $project_bug_percentage = $project['project_bug_percentage'];
        $label2 = '';
        if ($project_bug_percentage <= 15) {
            $label2 = 'bg-danger';
        } elseif ($project_bug_percentage > 15 && $project_bug_percentage <= 33) {
            $label2 = 'bg-warning';
        } elseif ($project_bug_percentage > 33 && $project_bug_percentage <= 70) {
            $label2 = 'bg-primary';
        } else {
            $label2 = 'bg-success';
        }
    ?>

    <div class="row">
        <?php if(!empty($arrErr)): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if(!empty($arrErr['system'])): ?>
                    <div class="alert alert-danger text-xs">
                        <?php echo e(__('are required in')); ?> <a href="<?php echo e(route('settings')); ?>" class=""><u>
                                <?php echo e(__('System Setting')); ?></u></a>
                    </div>
                <?php endif; ?>
                <?php if(!empty($arrErr['user'])): ?>
                    <div class="alert alert-danger text-xs">
                        <a href="<?php echo e(route('users')); ?>" class=""><u><?php echo e(__('here')); ?></u></a>
                    </div>
                <?php endif; ?>
                <?php if(!empty($arrErr['role'])): ?>
                    <div class="alert alert-danger text-xs">
                        <a href="<?php echo e(route('roles.index')); ?>" class=""><u><?php echo e(__('here')); ?></u></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-sm-12">
        <div class="row">
            <?php echo $__env->make('hrm.includes.dash-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Today&#039;s Not Clock In</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row g-3 flex-nowrap team-lists horizontal-scroll-cards">
                                    <div class="col-auto">
                                        <img src="http://localhost/storage/avatar.png" alt="">
                                        <p class="mt-2"><b>Welcome </b><?php echo e(Ucfirst(Auth::user()->name). "(" .Auth::user()->department->name. ")"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Tasks Overview')); ?></h5>
                                <h6 class="last-day-text"><?php echo e(__('Last 7 Days')); ?></h6>
                            </div>
                            <div class="card-body">
                                <div id="chart-sales" height="200" class="p-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Staff</h5>
                                    <div class="row  mt-4">
                                        <div class="col-md-12 col-sm-6">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-users"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Total Staff</p>
                                                    <h4 class="mb-0 text-success">7</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 my-3 my-sm-0">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-user"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Total Employee</p>
                                                    <h4 class="mb-0 text-primary">6</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-user"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Total Client</p>
                                                    <h4 class="mb-0 text-danger">1</h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Training</h5>
                                    <div class="row  mt-4">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-users"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Total Training</p>
                                                    <h4 class="mb-0 text-success">0</h4>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 my-3 my-sm-0">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-user"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Trainer</p>
                                                    <h4 class="mb-0 text-primary">0</h4>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-user-check"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Active Training</p>
                                                    <h4 class="mb-0 text-danger">0</h4>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="theme-avtar bg-secondary">
                                                    <i class="ti ti-user-minus"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <p class="text-muted text-sm mb-0">Done Training</p>
                                                    <h4 class="mb-0 text-secondary">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-xxl-6">
                            <div class="row">
                                <div class="col--xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row ">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="align-items-start">
                                                        <div class="ms-2">
                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Total Project')); ?>

                                                            </p>
                                                            <h3 class="mb-0 text-warning">
                                                                <?php echo e($project['project_percentage']); ?>%</h3>
                                                            <div class="progress mb-0">
                                                                <div class="progress-bar bg-<?php echo e($label1); ?>"
                                                                    style="width: <?php echo e($project['project_percentage']); ?>%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="align-items-start">
                                                        <div class="ms-2">
                                                            <p class="text-muted text-sm mb-0">
                                                                <?php echo e(__('Total Project Tasks')); ?></p>
                                                            <h3 class="mb-0 text-info">
                                                                <?php echo e($project['projects_tasks_count']); ?>%</h3>
                                                            <div class="progress mb-0">
                                                                <div class="progress-bar bg-<?php echo e($label1); ?>"
                                                                    style="width: <?php echo e($project['project_task_percentage']); ?>%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="align-items-start">

                                                        <div class="ms-2">

                                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Total Bugs')); ?></p>
                                                            <h3 class="mb-0 text-danger">
                                                                <?php echo e($project['projects_bugs_count']); ?>%</h3>
                                                            <div class="progress mb-0">
                                                                <div class="progress-bar bg-<?php echo e($label1); ?>"
                                                                    style="width: <?php echo e($project['project_bug_percentage']); ?>%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Project Status')); ?>

                                                <span
                                                    class="float-end text-muted"><?php echo e(__('Year') . ' - ' . $currentYear); ?></span>
                                            </h5>

                                        </div>
                                        <div class="card-body">
                                            <div id="chart-doughnut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                </div>


            </div>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-server\htdocs\e-NITT\resources\views/dashboard/clientView.blade.php ENDPATH**/ ?>