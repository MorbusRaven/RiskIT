 <form method="post"  class="form-size" id="add_details">
				<div class="input-group mb-3">
						<div class="input-group-prepend">
								<label class="input-group-text p-1 font-weight-bold" for="riskName">Risk Name:</label>
					</div>
						<select  class="custom-select" name="riskName" >
								<option value="">Select a risk</option>
										<?php
										$query = "SELECT riskName FROM risktable";
										$data = $connect->prepare($query);    
										$data->execute();
										while($row=$data->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="'.$row['id'].'">'.$row['riskName'].'</option>'; 
										}
										?>
						</select>
				</div>
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Impact</label>
            </div> 
            <input type="text" name="impact" class="form-control" required />
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Probability</label>
            </div>
            <input type="text" name="probability" class="form-control" required />