
<div class="row">
  <div class="col s8">
    <blockquote class="color-primary-green">
      <h3 class="color-black">Lecturer's Class List</h3>

    </blockquote>

  </div>

</div>

<div class="row">
  <div class="col s2">
    <div class="row">
      <div class="card bg-primary-yellow">
        <div class="card-content white-text">
          <span class="card-title color-black" style="text-transform: uppercase;">Sections</span>
          <?php foreach ($subject as $key => $value): ?>
            <button class="btn bg-primary-green <?=$value->offering_section?>" style="margin-bottom: 5%;"><i class="material-icons left ">play_arrow</i><?=$value->offering_section?></button>

          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col s10">
    <?php $x = 1;
    ?> 
    <?php foreach ($subject as $key => $value): ?>
      <?php   $display = $x == 1 ? "block" : "none"; ?>
      <div class="row <?=$value->offering_section?>" style="display: <?=$display?>;">
        <ul class="collapsible popout " data-collapsible="accordion">
          <li>
            <div class="collapsible-header  bg-primary-green color-white"><i class="material-icons">people_outline</i><?=$value->offering_section?></div>
            <div>
             <table id="tbl-card-lcl" style="padding: 2%;">
              <thead >
                <tr>
                  <th>Student ID</th>
                  <th>Last Name</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Program</th>
                  <th>Email</th>
                </tr>
              </thead>

              <tbody class="bg-color-white">
                <?php foreach ($student as $key => $value_inner): ?>
                  <tr class="bg-color-white">
                    <td><?= $value_inner->student_id ?></td>
                    <td><?= ucwords($value_inner->firstname) ?></td>
                    <td><?= ucwords($value_inner->midname) ?></td>
                    <td><?= ucwords($value_inner->lastname) ?></td>
                    <td><?= strtoupper($value_inner->student_program) ?></td>
                    <td><?=$value_inner->email?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </li>
      </ul>
    </div>
    <?php $x++; ?>
  <?php endforeach ?>
</div>
</div>
