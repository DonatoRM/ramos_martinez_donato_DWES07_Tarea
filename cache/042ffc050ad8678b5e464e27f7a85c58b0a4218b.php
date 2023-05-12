<?php $__env->startSection('title'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="../vendor/fortawesome/font-awesome/js/all.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <section class="vw-100 vh-100 d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title mt-1"><i class="fa-solid fa-gear me-3"></i>Registro</h2>
                </div>
                <div class="card-body">
                    <form name="formLogin" id="formLogin" method="POST" action="votes.php" target="_self">
                        <div class="input-group mb-3">
                            <label for="user" class="input-group-text"><i class="fa-solid fa-user"></i></label>
                            <input type="text" class="form-control" name="user" id="user" size="25"
                                placeholder="Usuarios" required>
                        </div>
                        <div class="input-group mb-3">
                            <label for="pass" class="input-group-text"><i class="fa-solid fa-key"></i></label>
                            <input type="password" class="form-control" name="pass" id="pass" size="25"
                                placeholder="Contraseña" required>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-azul text-white float-end" name="register"
                                id="register">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates/generalTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\donat\OneDrive\DAW\Segundo\MP0613 - Desenvolvemento web en contorno servidor\Tareas\ramos_martinez_donato_DWES07_Tarea\views/viewLogin.blade.php ENDPATH**/ ?>