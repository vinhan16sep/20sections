@extends('admin.category.base')
@section('action-content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="#" class="btn btn-primary" role="button">Add Item</a>
                    <div class="table-responsive">
                        <table id="table" class="table table_product">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Detail</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="mask_sm">
                                        <img src="https://i5.walmartimages.com/asr/83532a19-d7c2-4628-bfc9-defd8862820e_1.ce9eb1fa80f30adb291ccc08f36e50b2.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF">
                                    </div>
                                </td>
                                <td>Laptop</td>
                                <td>Sit amet salami venison chicken flank fatback doner.</td>
                                <td>
                                    <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">See Detail</button>
                                </td>
                                <td>Electricity</td>
                                <td>3.600</td>
                                <td>$300</td>
                                <td><span class="label label-success">Available</span></td>
                                <td>
                                    <a href="#" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                    <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="10">
                                    <div class="collapse" id="collapse_1">
                                        <div class="well">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Ingredients</th>
                                                        <th>Production</th>
                                                        <th>Made in</th>
                                                        <th>Weight</th>
                                                        <th>Volume</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2015</td>
                                                        <td>Alumium</td>
                                                        <td>Dell</td>
                                                        <td>China</td>
                                                        <td>1kg</td>
                                                        <td></td>
                                                        <td>New 99%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="mask_sm">
                                        <img src="https://media.istockphoto.com/photos/red-apple-picture-id495878092">
                                    </div>
                                </td>
                                <td>Apple</td>
                                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                <td>

                                </td>
                                <td>Fruit</td>
                                <td>7.322</td>
                                <td>$2</td>
                                <td><span class="label label-warning">Pending</span></td>
                                <td>
                                    <a href="#" id="dataActionEdit"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                    <a href="" id="dataActionDelete"><i class="fa fa-remove" aria-hidden="true"></i> </a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Detail</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END ACCORDION & CAROUSEL-->
</section>
@endsection