<?php $__env->startSection('title'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="../vendor/fortawesome/font-awesome/js/all.min.js"></script>
    <?php
        $xajax->printJavascript();
    ?>
    <script type="text/javascript" src="../js/votos.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <header class="vw-100 d-flex justify-content-end mt-2">
        <form id="formExit" name="formExit" method="POST" action="<?php echo e($_SERVER['PHP_SELF']); ?>" target="_self">
            <div class="d-flex justify-content-end me-2">
                <label for="user" class="form-label bg-verde border-0"><i
                        class="fa-solid fa-user fa-2xl pt-2 me-2"></i></label>
                <input type="text" name="user" id="user" value="<?php echo e($user); ?>"
                    class="form-control bg-verde text-white" size="15" readonly>
                <button type="submit" name="exit" id="exit" class="btn btn-naranja ms-2 me-3 px-3">Salir</button>
            </div>
        </form>
    </header>
    <main class="container-fluid">
        <section>
            <header class="text-center mt-3">
                <h3>Productos onLine</h3>
            </header>
            <div class="row">
                <div class="col-10 mx-auto text-center">
                    <table id='table' class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Valoración</th>
                                <th>Valorar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tableProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $register): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                        $nameForm = 'formVote-' . $register['id'];
                                        $idForm = 'formVote-' . $register['id'];
                                        $idSelect = 'numVoto-' . $register['id'];
                                        $nameSelect = 'numVoto-' . $register['id'];
                                        $idButton = 'voto-' . $register['id'];
                                        $nameButton = 'voto-' . $register['id'];
                                        $nameButton = 'voto-' . $register['id'];
                                        $idStars = 'stars-' . $register['id'];
                                        $nameStars = 'stars-' . $register['id'];
                                    ?>
                                    <form name="<?php echo e($nameForm); ?>" id="<?php echo e($idForm); ?>" method="POST"
                                        action="javascript: void(null)" target="_self">
                                        <td><?php echo e($register['id']); ?></td>
                                        <td><?php echo e($register['nombre']); ?></td>
                                        <td><span id="<?php echo e($idStars); ?>" name="<?php echo e($nameStars); ?>" class="">Sin
                                                valorar</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <select id="<?php echo e($idSelect); ?>" name="<?php echo e($nameSelect); ?>"
                                                        class="form-select">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <button type="submit" name="<?php echo e($nameButton); ?>"
                                                        id="<?php echo e($idButton); ?>" value="<?php echo e($register['id']); ?>"
                                                        class="btn btn-azul text-white">Votar</button>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates/generalTemplate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\donat\OneDrive\DAW\Segundo\MP0613 - Desenvolvemento web en contorno servidor\Tareas\ramos_martinez_donato_DWES07_Tarea\views/viewListing.blade.php ENDPATH**/ ?>