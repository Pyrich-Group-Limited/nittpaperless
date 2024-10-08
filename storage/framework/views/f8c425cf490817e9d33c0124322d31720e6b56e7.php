
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user.edit-user-component', ['userId' => $userId])->html();
} elseif ($_instance->childHasBeenRendered('VEzmA8d')) {
    $componentId = $_instance->getRenderedChildComponentId('VEzmA8d');
    $componentTag = $_instance->getRenderedChildComponentTagName('VEzmA8d');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('VEzmA8d');
} else {
    $response = \Livewire\Livewire::mount('user.edit-user-component', ['userId' => $userId]);
    $html = $response->html();
    $_instance->logRenderedChild('VEzmA8d', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php /**PATH C:\xampp-server\htdocs\nittpaperless\resources\views/user/edit.blade.php ENDPATH**/ ?>