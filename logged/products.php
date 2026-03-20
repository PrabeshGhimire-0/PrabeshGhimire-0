<?php
include "../dbconnection.php";
$emojis = ['📱','📲','📳','☎️','📵','🔋','💻','📟'];
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
 
<section class="products-section" id="products">
    <div class="section-heading">
        <h2>🛒 Our Smartphones</h2>
        <p>Premium handsets, competitive prices — all in one place</p>
    </div>
 
    <div class="products-grid">
        <?php
        $i = 0;
        if ($result && $result->num_rows > 0):
            while ($p = $result->fetch_assoc()):
                $emoji = $emojis[$i % count($emojis)];
                $i++;
                $discounted = $p['discountpercent'] > 0
                    ? round($p['price'] * (1 - $p['discountpercent'] / 100))
                    : null;
        ?>
        <div class="product-card">
            <?php if ($p['discountpercent'] > 0): ?>
                <span class="badge">-<?php echo $p['discountpercent']; ?>%</span>
            <?php endif; ?>
 
            <div class="phone-img"><?php echo $emoji; ?></div>
 
            <?php if (!empty($p['brand'])): ?>
                <span class="brand-tag"><?php echo htmlspecialchars($p['brand']); ?></span>
            <?php endif; ?>
 
            <h3><?php echo htmlspecialchars($p['productname']); ?></h3>
 
            <?php if (!empty($p['description'])): ?>
                <p class="desc"><?php echo htmlspecialchars($p['description']); ?></p>
            <?php endif; ?>
 
            <span class="stock-badge <?php echo ($p['stock'] > 0) ? 'in-stock' : 'out-stock'; ?>">
                <?php echo ($p['stock'] > 0) ? '✓ In Stock (' . $p['stock'] . ')' : '✗ Out of Stock'; ?>
            </span>
 
            <div class="price-row">
                <?php if ($discounted): ?>
                    <span class="price-original">Rs <?php echo number_format($p['price']); ?></span>
                    <span class="price-final">Rs <?php echo number_format($discounted); ?></span>
                <?php else: ?>
                    <span class="price-final">Rs <?php echo number_format($p['price']); ?></span>
                <?php endif; ?>
            </div>
 
            <button class="btn-cart">Add to Cart</button>
        </div>
        <?php
            endwhile;
        else:
        ?>
        <div class="no-products">
            <div class="icon">📦</div>
            <p>No products available yet. Check back soon!</p>
        </div>
        <?php endif; ?>
    </div>
</section>