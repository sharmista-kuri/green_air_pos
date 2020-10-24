<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    @include('includes.script')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html --> 
        @include('includes.header')
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      
        @include('includes.sidebar')
      
      <!-- partial -->
      <div class="main-panel"> 
             
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('includes.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  
  <!-- End custom js for this page-->
</body>

</html>

