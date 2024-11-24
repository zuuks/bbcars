<?php if (!empty ($_page_view['breadcrumbs'])): ?>
	<breadcrumbs>
		<?php foreach ($_page_view['breadcrumbs'] as $url => $label): ?>
			<a href="<?= $url ?>">
				<?= $label ?>
			</a>
		<?php endforeach; ?>
	</breadcrumbs>
<?php endif; ?>

<h1 style="text-align:center; color:white;">
	<?= $_page_view['page_title'] ?>
</h1>

<error>
	<?php if (!empty ($_page_view['_error'])): ?>
		<ul>
			<?php foreach ($_page_view['_error'] as $k => $v): ?>
				<li style="color:white; font-size:25px;">
					<?= $v ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</error>
<message>
	<?php if (!empty ($_page_view['_message'])): ?>
		<ul>
			<?php foreach ($_page_view['_message'] as $k => $v): ?>
				<li>
					<?= $v ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</message>
<?php if (($_page_view['admin_confirmation'] ?? '') == 1): ?>
	<form method="post" class="formaBrisi">
		<div style="color:white;">Da li ste sigurni da želite da obrišete ovaj auto?</div>
		<button name="confirm_action" value="1" class="kontaktSalji">Da</button>
		<button name="confirm_action" value="0" class="kontaktSalji">Ne</button>
	</form>
<?php endif; ?>

