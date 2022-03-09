<style>
body {
  margin: 20px auto;
  font-family: 'Lato';
  font-weight: 300;
  width: 600px;
  text-align: center;
}

button {
  background: cornflowerblue;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 8px;
  font-family: 'Lato';
  margin: 5px;
  text-transform: uppercase;
  cursor: pointer;
  outline: none;
}

button:hover {
  background: orange;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<button class="first">Bottom Toast</button>
<button class="second">Animated Toast</button>
<button class="third">Error Toast</button>
    
</body>
</html>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

document.querySelector(".first").addEventListener('click', function(){
  Swal.fire({
    toast: true,
    icon: 'success',
    title: 'Posted successfully',
    animation: false,
    position: 'bottom',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
});

document.querySelector(".second").addEventListener('click', function(){
  toastMixin.fire({
    animation: true,
    title: 'Signed in Successfully'
  });
});

document.querySelector(".third").addEventListener('click', function(){
  toastMixin.fire({
    title: 'Wrong Password',
    icon: 'error'
  });
});
</script>