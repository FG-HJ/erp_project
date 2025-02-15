

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payslip')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('payslip')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'hr'): ?>
        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['payslip.store'], 'method' => 'POST', 'id' => 'payslip_form'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">
                                <Label class="form-label">Fecha de inicio</Label>
                               
                                    <input type="date"  name="start" class="form-control" id="datePicker11" value=<?php echo e(date_format($start,"Y-m-d")); ?>>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">
                                <Label class="form-label">Fecha final</Label>
                                    <input type="date"  name="end" class="form-control" id="datePicker12" value=<?php echo e(date_format($end,"Y-m-d")); ?>>
                            </div>
                        </div>
                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn  btn-primary"
                                onclick="document.getElementById('payslip_form').submit(); return false;"
                                data-bs-toggle="tooltip" title="<?php echo e(__('payslip')); ?>"
                                data-original-title="<?php echo e(__('payslip')); ?>"><?php echo e(__('Generate Payslip')); ?>

                            </a>
                        </div>
                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn  btn-primary"
                                id="searchdata"
                                data-bs-toggle="tooltip" title="<?php echo e(__('payslip')); ?>"
                                data-original-title="<?php echo e(__('payslip')); ?>"><?php echo e(__('Payslip list')); ?>

                            </a>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <div class="d-flex align-items-center justify-content-start mt-2">
                            <h5><?php echo e(__('Find Employee Payslip')); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex align-items-center justify-content-end ">
                            <!-- <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <input type="date"  name="searchdate" class="form-control"id="datePicker21" >
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <input type="date"  name="searchdate" class="form-control"id="datePicker22" >
                                </div>
                            </div> -->
                           
                            <?php if(Auth::user()->type == 'company' || Auth::user()->type == 'hr'): ?>
                                <?php echo e(Form::open(['route' => ['payslip.export'], 'method' => 'POST', 'id' => 'payslip_form'])); ?>

                                <input type="hidden" name="filter_month" class="filter_month">
                                <input type="hidden" name="filter_year" class="filter_year">
                                <input type="submit" value="<?php echo e(__('Export')); ?>" class="btn btn-primary">
                                <?php echo e(Form::close()); ?>

                            <?php endif; ?>
                            
                            <div class="ml-2 float-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Pay Slip')): ?>
                                    <input type="button" value="<?php echo e(__('Bulk Payment')); ?>" class="btn btn-primary"
                                        style="margin-left: 5px" id="bulk_payment">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-render-column-cells">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Employee Id')); ?></th>
                                <?php if(\Auth::user()->type != 'employee'): ?>
                                    <th><?php echo e(__('Name')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Payroll Type')); ?></th>
                                <th><?php echo e(__('Salary')); ?></th>
                                <th><?php echo e(__('Nómina')); ?></th>
                                <th><?php echo e(__('Complemento')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<style>
    .cusor:hover{
        cursor: pointer;
    }
    #payslip_form{
        margin-bottom: 0px;
    }
</style>
<?php $__env->startPush('script-page'); ?>
    <script>
        function paidstatus(payslipid, status){
          
            if (confirm("Do you want to pay to this employee?")==true){
                $.ajax({
                    url: 'payslip/paystatus/'+ payslipid,
                    type: 'GET',
                    success: function(data) {
                        $("#"+payslipid).removeClass("bg-danger");
                          $("#"+payslipid).addClass("bg-success");
                           $("#"+payslipid).text("Paid");
                        //  $this.removeClass("bg-danger");
                        //  $this.addClass("bg-success");
                     
                    }
                });
            }                         
        }
       
    //   var today = new Date();

    //     var dd = today.getDate();
    //     var mm = today.getMonth() + 1; //January is 0!
    //     var yyyy = today.getFullYear();

    //     if (dd < 10) {
    //     dd = '0' + dd
    //     }

    //     if (mm < 10) {
    //     mm = '0' + mm
    //     }

    //     // today = yyyy + '/' + mm + '/' + dd;
    //     today = `${yyyy}-${mm}-${dd}`;
    //     // beforeAWeek = `${yyyy}-${mm}-${dd-7}`;
    //     beforeAWeek = "2024-08-01";
    //     document.getElementById('datePicker11').value = beforeAWeek;
    //     // document.getElementById('datePicker21').value = beforeAWeek;
    //     document.getElementById('datePicker12').value = today;
        // document.getElementById('datePicker22').value = today;
        $(document).ready(function() {
            
            callback();

            function callback() {
                var start = $("#datePicker11").val();
                var end = $("#datePicker12").val();
                
                $.ajax({
                    url: '<?php echo e(route('payslip.search_json')); ?>',
                    type: 'POST',
                    data: {
                        // "datePicker": datePicker,
                        "start":start,
                        "end":end,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(data) {
              
                        var datatable_data = {
                            data: data
                        };
                        console.log(data);
                        if (data.lenght>0){
                            document.getElementById('datePicker11').value = data[0][7];
                            document.getElementById('datePicker12').value = data[0][8];
                            
                        }
                        function renderstatus(data, cell, row) {
                            if (data == 'Paid')
                                return '<div class="badge bg-success p-2 px-3 rounded"><a href="#" class="text-white">' +
                                    data + '</a></div>';
                            else
                                return '<div class="badge bg-danger p-2 px-3 rounded"><a href="#" class="text-white">' +
                                    data + '</a></div>';
                        }
                        
                        function renderButton(data, cell, row) {

                            var $div = $(row);
                            employee_id = $div.find('td:eq(0)').text();
                            status = $div.find('td:eq(6)').text();

                            var month = $(".month_date").val();
                            var year = $(".year_date").val();
                            var id = employee_id;
                            var payslip_id = data;
                            var clickToPaid = '';
                            var payslip = '';
                            var view = '';
                            var edit = '';
                            var deleted = '';
                            var form = '';

                            if (data != 0) {
                                var payslip =
                                    '<a href="#" data-url="<?php echo e(url('payslip/pdf/')); ?>/' + id +
                                    '/' + "datePicker" +
                                    '" data-size="md-pdf"  data-ajax-popup="true" class="btn btn-primary" data-title="<?php echo e(__('Employee Payslip')); ?>">' +
                                    '<?php echo e(__('Payslip')); ?>' + '</a> ';
                            }

                            if (status == "UnPaid" && data != 0) {
                                clickToPaid = '<a href="<?php echo e(url('payslip/paysalary/')); ?>/' + id +
                                    '/' + "datePicker" + '"  class="view-btn primary-bg btn-sm">' +
                                    '<?php echo e(__('Click To Paid')); ?>' + '</a>  ';
                            }

                            if (data != 0) {
                                view =
                                    '<a href="#" data-url="<?php echo e(url('payslip/showemployee/')); ?>/' +
                                    payslip_id +
                                    '"  data-ajax-popup="true" class="view-btn gray-bg" data-title="<?php echo e(__('View Employee Detail')); ?>">' +
                                    '<?php echo e(__('View')); ?>' + '</a>';
                            }

                            if (data != 0 && status == "UnPaid") {
                                edit =
                                    '<a href="#" data-url="<?php echo e(url('payslip/editemployee/')); ?>/' +
                                    payslip_id +
                                    '"  data-ajax-popup="true" class="view-btn blue-bg" data-title="<?php echo e(__('Edit Employee salary')); ?>">' +
                                    '<?php echo e(__('Edit')); ?>' + '</a>';
                            }

                            var url = '<?php echo e(route('payslip.delete', ':id')); ?>';
                            url = url.replace(':id', payslip_id);

                            <?php if(\Auth::user()->type != 'Employee'): ?>
                                if (data != 0) {
                                    deleted = '<a href="#"  data-url="' + url +
                                        '" class="payslip_delete view-btn red-bg" >' +
                                        '<?php echo e(__('Delete')); ?>' + '</a>';
                                }
                            <?php endif; ?>

                            return view + payslip + clickToPaid + edit + deleted + form;
                        }

                        console.clear();
                        var tr = '';
                        if (data.length > 0) {
                            console.log(data);
                            
                            $.each(data, function(indexInArray, valueOfElement) {
                                var variable=valueOfElement[10] +", '"+ valueOfElement[9] + "'";
                                var status =
                                    '<div class="badge bg-danger p-2 px-3 rounded cusor" id="'+valueOfElement[10]+'" onclick="paidstatus('+ variable +')"><a  class="text-white">' +
                                    valueOfElement[9] + '</a></div>';
                                if (valueOfElement[9] == 'Paid') {
                                    var status =
                                        '<div class="badge bg-success p-2 px-3 rounded"><a href="#" class="text-white">' +
                                        valueOfElement[9] + '</a></div>';
                                }

                                var id = valueOfElement[0];
                                var employee_id = valueOfElement[1];
                                var payslip_id = valueOfElement[10];

                                if (valueOfElement[7] != 0) {
                                    var payslip =
                                        '<a href="#" data-url="<?php echo e(url('payslip/pdf/')); ?>/' +
                                        id +
                                        '/' + valueOfElement[10] +
                                        '" data-size="lg"  data-ajax-popup="true" class=" btn-sm btn btn-warning" data-title="<?php echo e(__('Employee Payslip')); ?>">' +
                                        '<?php echo e(__('Payslip')); ?>' + '</a> ';
                                }
                                if (valueOfElement[6] == "UnPaid" && valueOfElement[7] != 0) {
                                    var clickToPaid =
                                        '<a href="<?php echo e(url('payslip/paysalary/')); ?>/' + id +
                                        '/' + "datePicker" +
                                        '"  class="btn-sm btn btn-primary">' +
                                        '<?php echo e(__('Click To Paid')); ?>' + '</a>  ';
                                } else {
                                    var clickToPaid = '';
                                }

                                if (valueOfElement[7] != 0 && valueOfElement[6] == "UnPaid") {
                                    var edit =
                                        '<a href="#" data-url="<?php echo e(url('payslip/editemployee/')); ?>/' +
                                        payslip_id +
                                        '"  data-ajax-popup="true" class="btn-sm btn btn-info" data-title="<?php echo e(__('Edit Employee salary')); ?>">' +
                                        '<?php echo e(__('Edit')); ?>' + '</a>';
                                } else {
                                    var edit = '';
                                }

                                var url = '<?php echo e(route('payslip.delete', ':id')); ?>';
                                url = url.replace(':id', payslip_id);

                                <?php if(\Auth::user()->type != 'Employee'): ?>
                                    if (valueOfElement[7] != 0) {
                                        var deleted = '<a href="#"  data-url="' + url +
                                            '" class="payslip_delete view-btn btn btn-danger ms-1 btn-sm"  >' +
                                            '<?php echo e(__('Delete')); ?>' + '</a>';
                                    } else {
                                        var deleted = '';
                                    }
                                <?php endif; ?>

                                <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'hr'): ?>
                                    var deleted = '<a href="#"  data-url="' + url +
                                        '" class="payslip_delete view-btn btn btn-danger ms-1 btn-sm"  >' +
                                        '<?php echo e(__('Delete')); ?>' + '</a>';
                                <?php else: ?>
                                    var deleted = '';
                                <?php endif; ?>

                                var url_employee = valueOfElement['url'];
                                <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'hr'): ?>
                                    tr +=
                                        '<tr>' +
                                        '<td> <a class="btn btn-outline-primary" href="' +
                                        url_employee + '">' + valueOfElement[1] + '</a></td> ' +
                                        '<td>' + valueOfElement[2] + '</td> ' +
                                        '<td>' + valueOfElement[3] + '</td>' +
                                        '<td>' + valueOfElement[4] + '</td>' +
                                        '<td>' + valueOfElement[5] + '</td>' +
                                        '<td>' + valueOfElement[6] + '</td>' +
                                        '<td>' + status + '</td>' +
                                        '<td>' + payslip + clickToPaid + edit + deleted +
                                        '</td>' +
                                        '</tr>';
                                <?php else: ?>
                                    tr +=
                                        '<tr>' +
                                        '<td> <a class="btn btn-outline-primary" href="' +
                                        url_employee + '">' + valueOfElement[1] + '</a></td> ' +
                                        '<td>' + valueOfElement[2] + '</td> ' +
                                        '<td>' + valueOfElement[4] + '</td>' +
                                        '<td>' + valueOfElement[5] + '</td>' +
                                        '<td>' + valueOfElement[6] + '</td>' +
                                        '<td>' + status + '</td>' +
                                        '<td>' + payslip + clickToPaid + edit + deleted +
                                        '</td>' +
                                        '</tr>';
                                <?php endif; ?>
                            });
                        } else {
                            var colspan = $('#pc-dt-render-column-cells thead tr th').length;
                            var tr = '<tr><td class="dataTables-empty" colspan="' + colspan +
                                '"><?php echo e(__('No entries found')); ?></td></tr>';
                        }
                        
                        $('#pc-dt-render-column-cells tbody').html(tr);
                        var table = document.querySelector("#pc-dt-render-column-cells");
                        var datatable = new simpleDatatables.DataTable(table);
                    },
                    error: function(data) {

                    }
                });
            }
           
            $(document).on("click", "#searchdata", function() {
                callback();
            });
            
            

            //bulkpayment Click
            $(document).on("click", "#bulk_payment", function() {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '_' + month;

            });
            $(document).on('click', '#bulk_payment',
                'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]',
                function() {
                    var month = $(".month_date").val();
                    var year = $(".year_date").val();
                    var datePicker = year + '-' + month;

                    var title = 'Bulk Payment';
                    var size = 'md';
                    var url = 'payslip/bulk_pay_create/' + datePicker;

                    // return false;

                    $("#commonModal .modal-title").html(title);
                    $("#commonModal .modal-dialog").addClass('modal-' + size);
                    $.ajax({
                        url: url,
                        success: function(data) {
                        
                            // return false;
                            if (data.length) {
                                $('#commonModal .body').html(data);
                                $("#commonModal").modal('show');
                                // common_bind();
                            } else {
                                show_toastr('error', 'Permission denied.');
                                $("#commonModal").modal('hide');
                            }
                        },
                        error: function(data) {
                            data = data.responseJSON;
                            show_toastr('error', data.error);
                        }
                    });
                });

            $(document).on("click", ".payslip_delete", function() {
                var confirmation = confirm("are you sure you want to delete this payslip?");
                var url = $(this).data('url');

                if (confirmation) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data);
                            // show_toastr(data.status, data.msg, 'data.status');
                            show_toastr('error', 'Payslip Deleted Successfully', 'success');

                            setTimeout(function() {
                                location.reload();
                            }, 800)
                        },
                    });
                }
            });
            $(document).on("change", "#datePicker11", function() {
                 var start = $("#datePicker11").val();
                  $("#datePicker12").val(start);
            })
            
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ix8ccsto9l8d/public_html/f100.com.mx/nomina/resources/views/payslip/index.blade.php ENDPATH**/ ?>