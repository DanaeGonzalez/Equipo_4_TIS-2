<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>Posts</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href=<?php echo e(route('posts.index')); ?>>CRUDPosts</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href=<?php echo e(route('posts.create')); ?>>Add Post</a>
        </div>
      </div>
    </div>
  </nav>
  <!-- same as the previous file. Add the following after the nav tag and before the closing body tag. -->
<div class="container h-100 mt-5">
  <div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Add a Post</h3>
      <form action="<?php echo e(route('posts.store')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
    </div>
  </div>
</div>
  <div class="container mt-5">
    <div class="row">
      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?php echo e($post->title); ?></h5>
            </div>
            <div class="card-body">
              <p class="card-text"><?php echo e($post->body); ?></p>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm">
                  <a href="<?php echo e(route('posts.edit', $post->id)); ?>"
            class="btn btn-primary btn-sm">Edit</a>
                </div>
                <div class="col-sm">
                    <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\xampp\Equipo_4_TIS-2\example-app\resources\views/posts/create.blade.php ENDPATH**/ ?>