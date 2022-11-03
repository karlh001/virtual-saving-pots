
</main><!-- /.container -->

<br>
<br>

<!-- Footer -->

  <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      &copy; <?php echo date("Y"); ?>
      <a class="text-dark" href="https://github.com/karlh001/virtual-saving-pots">karlh001</a>
	  <br><small>Version 1.1.6</small>
	  <br><a href = "https://github.com/karlh001/virtual-saving-pots/issues" title = "Known bugs and issues">Bugs</a>
	  | <a href = "https://github.com/karlh001/virtual-saving-pots/blob/master/LICENCE" title = "Read the licence">Licence</a>
    </div>
    <!-- Copyright -->
  </footer>

<?php


mysqli_close($conn);

echo "</body>\n</html>";

?>
