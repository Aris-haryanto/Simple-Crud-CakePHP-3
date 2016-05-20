
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-4">
			<div class="panel panel-default">
				<div class="panel-heading">Add User</div>
				<div class="panel-body">
					<?php $this->loadHelper('Form', [
							    'templates' => 'bootstrap_template_form',
							]);
					?>
					<?php echo $this->Form->create(null, ['url' => '/users/add', 'type' => 'file']); ?>
						<?php echo $this->Form->input('Name', ['required' => true, 'name' => 'nama', 'class' => 'form-control']); ?>
						<?php echo $this->Form->input('Email', ['required' => true, 'type' => 'email', 'name' => 'email', 'class' => 'form-control']); ?>
						<?php echo $this->Form->input('Add User', ['type' => 'submit', 'class' => 'form-control btn btn-primary']); ?>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-sm-8 col-xs-8">
			<div class="panel panel-default">
				<div class="panel-heading">List User</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover">
						<thead><?php echo $this->Html->tableHeaders(['No', 'Nama', 'Email', 'Actions']); ?></thead>
						<tbody>
							<?php 
								$i = 1;
								foreach($get_data as $data){
									echo $this->Html->tableCells([
																	$i, 
																	$data['nama'], 
																	$data['email'],
																	'<a href="'.$this->Url->build('/users/edit/'.$data['id'], true).'" class="btn btn-success">Edit</a>
																	<a href="#" data-target="#delete-'.$i.'" data-toggle="modal" class="btn btn-danger">Delete</a>'
																]);
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>
