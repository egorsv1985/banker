<? /*******************************************************************************************************************
 * This file is the part of VPlatform project https://market.info92.ru
 * Copyright (C) 2013-2020, mall92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="expenseGridtoReport.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php if ($model !== null): ?>
  <table border="1">

    <tr>
      <th width="80px">
        id
      </th>
      <th width="80px">
        uid
      </th>
      <th width="80px">
        num_iid
      </th>
      <th width="80px">
        date
      </th>
      <th width="80px">
        cid
      </th>
      <th width="80px">
        express_fee
      </th>
      <th width="80px">
        price
      </th>
      <th width="80px">
        promotion_price
      </th>
      <th width="80px">
        pic_url
      </th>
      <th width="80px">
        seller_rate
      </th>
    </tr>
      <?php foreach ($model as $row): ?>
        <tr>
          <td>
              <?php echo $row->id; ?>
          </td>
          <td>
              <?php echo $row->uid; ?>
          </td>
          <td>
              <?php echo $row->num_iid; ?>
          </td>
          <td>
              <?php echo $row->date; ?>
          </td>
          <td>
              <?php echo $row->cid; ?>
          </td>
          <td>
              <?php echo $row->express_fee; ?>
          </td>
          <td>
              <?php echo $row->price; ?>
          </td>
          <td>
              <?php echo $row->promotion_price; ?>
          </td>
          <td>
              <?php echo $row->pic_url; ?>
          </td>
          <td>
              <?php echo $row->seller_rate; ?>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
<?php endif; ?>
