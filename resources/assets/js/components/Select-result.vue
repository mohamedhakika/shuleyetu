<template>
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">List of students that allready assessed.</h4>
          <p class="category">Here we go</p>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>STUDENT NAME</th>
                <th class="text-right">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-right">1</td>
                <td>Juma Hakika</td>
                <td class="td-actions text-right">
                  <a href="#" class="btn btn-default btn-xs pull-right">
                    <i class="ti-arrow-right"></i>
                    View
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-12">
      <div class="card" style="min-height: 400px">
        <div class="header card-header-text">
          <h4 class="title">Pick student to assess</h4>
          <p class="category"> Here we go again.</p>
        </div>
        <div class="content table-responsive">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th class="text-right">No</th>
                <th>STUDENT NAME</th>
                <th class="text-right">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-right">1</td>
                <td>Magumashi ya Hakika</td>
                <td class="td-actions text-right">
                  <a href="#" class="btn btn-default btn-xs pull-right">
                    <i class="ti-arrow-right"></i>
                    Assess
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Select student component is mounted.')
        }
    }
</script>
