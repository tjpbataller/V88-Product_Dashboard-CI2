$(document).ready(function(){
    $("i.delete-btn").on("click",function(data){
        let product_name = $(this).parent().siblings("td.product-name").text();
        let product_id = $(this).attr("data-product-id");
        $("div.modal-body p").text(product_name);
        $("form.modal-footer").attr("action", "/products/delete/"+product_id);
    });
})