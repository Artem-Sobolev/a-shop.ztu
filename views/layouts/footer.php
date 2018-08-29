    <div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2018</p>
                <p class="pull-right">Курсовая работа</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });

    });
</script>
<script>
    $('div.comments').delegate('a[data-comment-id]','click', function(e){
        e.preventDefault();
        var id = $(this).attr("data-comment-id");
        $.post("/comment/delete/"+id, function (data) {
            $("div.comments").html(data);
        });
    });

    $('div.comments').delegate('#commentForm','submit', function(e){
        e.preventDefault();
        $.post("/comment/add", {'message':$('input[name="message"]').val(),
                'userId' : <?php echo $_SESSION['user'] ?>,
                'productId' : <?php echo $productId ?>},
            function(data) {
                $('div.comments').html(data);
            });
    });
</script>
</body>
</html>