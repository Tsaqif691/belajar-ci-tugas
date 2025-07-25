<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'home') ? "" : "collapsed" ?>" href="/">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
                <i class="bi bi-cart-check"></i>
                <span>Keranjang</span>
            </a>
        </li><!-- End Keranjang Nav -->
        <?php
        if (session()->get('role') == 'admin') {
            ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
                    <i class="bi bi-receipt"></i>
                    <span>Produk</span>
                </a>
            </li><!-- End Produk Nav -->
            
            <?php if (session()->get('role') == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (uri_string() == 'diskon') ? '' : 'collapsed' ?>"
                        href="<?= base_url('diskon') ?>">
                        <i class="bi bi-percent"></i>
                        <span>Diskon</span>
                    </a>
                </li><!-- End Diskon Nav -->
            <?php endif; ?>
            <?php
        }
        ?>
        <?php
        if (session()->get('role') == 'admin') {
            ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (uri_string() == 'productkategori') ? "" : "collapsed" ?>"
                    href="productkategori">
                    <i class="bi bi-receipt"></i>
                    <span>Product kategori</span>
                </a>
            </li><!-- End Produk kategori Nav -->
            <?php
        }
        ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'profile') ? "" : "collapsed" ?>" href="profile">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo (uri_string() == 'Faq') ? "" : "collapsed" ?>" href="Faq">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Nav -->

    </ul>

</aside><!-- End Sidebar-->