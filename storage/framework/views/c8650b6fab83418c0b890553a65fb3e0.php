<?php if (isset($component)) { $__componentOriginal447cb07a00de5a07df2d38ad54e9fb9c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal447cb07a00de5a07df2d38ad54e9fb9c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'admin::components.layouts.master','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin::layouts.master'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('admin.name'); ?></p>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal447cb07a00de5a07df2d38ad54e9fb9c)): ?>
<?php $attributes = $__attributesOriginal447cb07a00de5a07df2d38ad54e9fb9c; ?>
<?php unset($__attributesOriginal447cb07a00de5a07df2d38ad54e9fb9c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal447cb07a00de5a07df2d38ad54e9fb9c)): ?>
<?php $component = $__componentOriginal447cb07a00de5a07df2d38ad54e9fb9c; ?>
<?php unset($__componentOriginal447cb07a00de5a07df2d38ad54e9fb9c); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\modulosige-formativo\Modules\Admin\resources\views\index.blade.php ENDPATH**/ ?>