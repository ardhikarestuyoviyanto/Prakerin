<footer class="py-3 bg-dark <?php if(isset($location)): ?> fixed-bottom" style="margin-top: 690px;" <?php else: ?>" style="margin-top: 90px;" <?php  endif; ?>>
    <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy;  <?php foreach($app as $x): echo $x->nama_app; endforeach; ?></p></div>
</footer>
