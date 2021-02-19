<style type="text/css">
    
    .page_headers {
        padding: 150px 0 150px 0;
        background-color: #25258E;
    }
</style>


        <div class="page_headers">
            <div class="header_contents">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="haeder-text">
                                <?php echo form_open('home/product_payment',array('name'=>'pay_product'));?>
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" value="tareq7500@gmail.com" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_name" class="form-control" value="Apple" placeholder="Product name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_qty" class="form-control" value="2" placeholder="Product Quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_model" class="form-control" value="PRO789" placeholder="Product Model" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_price" class="form-control" value="1500" placeholder="Product price" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="gateway" class="form-control" value="limarket" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Payment</button>
                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->