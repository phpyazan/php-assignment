<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Assignment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="padding: 25px;">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">Product List</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="query" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="card-body content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Discount</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="results">
                            <?php foreach ($products->data as $product): ?>
                            <tr>
                                <th scope="row"><?php echo $product->id; ?></th>
                                <td><?php echo $product->name; ?></td>
                                <td class="text-center"><?php echo $product->price; ?></td>
                                <td class="text-center"><?php echo $product->discount_amount; ?></td>
                                <td class="text-center">
                                    <a href="#" data-id="<?php echo $product->id; ?>"
                                        class="btn btn-primary btn-sm show-detail">Detail</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php foreach ($pagination as $item): ?>
                            <li class="<?php echo $item["class"]; ?>">
                                <a class="page-link" href="<?php echo $item["url"]; ?>"><?php echo $item["page"]; ?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="productModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title product_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="product_image mb-3"><img src="" alt=""></div>
                    <div class="product_description"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).on("keyup", "input[name=query]", function() {
        $.ajax({
            type: "POST",
            url: "/search",
            data: {
                query: $(this).val(),
                page: "<?php echo $this->uri_segment(2); ?>"
            },
            dataType: "json",
            success: function(r) {
                $(".content").html(r.content);
            }
        })
    });
    $(document).on("click", "a.show-detail", function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/product",
            data: {
                id: $(this).data("id")
            },
            dataType: "json",
            success: function(r) {
                var product = r.data;
                $(".product_title").text(product.name);
                $(".product_description").text(product.description);
                $(".product_image img").attr("src", product.image);
                $("#productModal").modal("show");
            }
        })
    });
    </script>
</body>

</html>