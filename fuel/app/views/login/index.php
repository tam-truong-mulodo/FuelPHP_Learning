<?php if (isset($html_error)): ?>
<?php echo $html_error; ?>
<?php endif; ?>

<?php echo Form::open('form/confirm'); ?>
<p>
	<?php echo Form::label('名前またはメールアドレス', 'name'); ?>
	<?php echo "<br>"; ?>
    <?php echo Form::input('name', Input::post('name')); ?>
</p>
<p>
	<?php echo Form::label('パスワード', 'password'); ?> 
	<?php echo "<br>"; ?>
	<?php echo Form::input('password', Input::post('password')); ?>
</p>
<div class="actions">
	<?php echo Form::submit('submit', 'ログイン'); ?> 
</div>
<?php echo Form::close(); ?>