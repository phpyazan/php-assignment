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
                <a href="#" data-id="<?php echo $product->id; ?>" class="btn btn-primary btn-sm show-detail">Detail</a>
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