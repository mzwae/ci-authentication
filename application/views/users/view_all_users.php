<h2><?=$page_heading?></h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if($query->num_rows() > 0): ?>
      <?php foreach($query->result() as $row): ?>
        <tr>
          <td><?=$row->usr_id?></td>
          <td><?=$row->usr_fname?></td>
          <td><?=$row->usr_lname?></td>
          <td><?=$row->usr_email?></td>
          <td><a href="users/edit_user/<?=$row->usr_id?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="5" class="info">No users here!</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
