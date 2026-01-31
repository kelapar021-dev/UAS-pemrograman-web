</div> <!-- Close content-box -->
    
    <div style="margin-top: 50px; padding: 30px; border-top: 1px solid rgba(0,0,0,0.05); text-align: center;">
        <p style="font-size: 13px; color: #aaa; margin-bottom: 5px;">
            &copy; <?= date('Y'); ?> <b>Sunset Sport Management System</b>. 
        </p>
        <p style="font-size: 11px; color: #ccc; letter-spacing: 1px;">
            Built with Passion for Sport Centers v1.0
        </p>
    </div>

</div> <!-- Close main-content -->

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    // Script otomatis untuk memberikan efek shadow pada top-nav saat scroll
    window.onscroll = function() {
        var nav = document.querySelector('.top-nav');
        if (nav) {
            if (window.pageYOffset > 10) {
                nav.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
            } else {
                nav.style.boxShadow = "0 2px 5px rgba(0,0,0,0.05)";
            }
        }
    };

    // Script konfirmasi hapus global (opsional)
    function konfirmasiHapus(url) {
        if (confirm('Apakah Bos yakin ingin menghapus data ini? Data yang dihapus tidak bisa dikembalikan.')) {
            window.location.href = url;
        }
    }
</script>

</body>
</html>