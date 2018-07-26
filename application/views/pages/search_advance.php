<style type="text/css">
	body{
		background: rgba(250,250,250,0.8);
	}
	.advanced_search input[type='text'] {
		background: none;
	}
</style>
<div class="col col-md-9 col-sm-9 col-lg-10 dark-scrollbar" style="height:85vh;overflow-y:auto;padding-bottom:150px;">

	

	<div class="col col-xs-12">

			<div class="col row">			<!--first-->
				<article class="col col-md-12 col-lg-6">
					<div class="col col-lg-12"  style="background: #fff;border-radius: 10px;box-shadow: 0px 0px 3px rgba(200,200,200,0.7);padding: 20px 20px;margin-top: 50px;">

						<h3 class="text-muted"><i class="material-icons md-36">find_in_page</i> Advanced Search</h3>	
						<p>Advanced search is a full search of the entire dictionary text. It finds your term wherever it occurs in the dictionary. This could be in the form of an entry name, part of another word's definition, in a quotation, etc. An Advanced search also allows you to search for words that occur near one another, such as bread before butter.</p>
					</div>
				</article>
			</div>
			<div class="row">

				<article  class="col col-md-12 col-lg-6"><br/>
					<div class="col col-lg-12 text-muted text-justify">	
					
					</div>
				</article>
			</div>
				
				<?php echo form_open('advance/search/result/','class="form-horizontal advanced_search"  method="GET"');  ?>
	

			<!--first-->
			<article class="col col-md-12 col-lg-6">
				<div class="col col-lg-12"  style="padding: 20px 20px;margin-top: 50px;"></div>


				<h5 class="page-header text-muted"><b><i class="material-icons">query_builder</i> Advanced filter</b></h5>
				<p class="text-danger"><small>*Please use  <b>|</b> sign for multi-valued fields. Ex. Title: <u>development support | agriculture</u>  </small></p><hr/><br/>
				
				<?php for ($x  = 0; $x <= 3; $x++){ ?>
					<main>
						<section class="col col-lg-4">
							<div class="form-group">
								<select class="form-control" name="__<?php echo $x; ?>__field">
									<option name="all" value="all">All Fields</option>
									<?php foreach($data['fields'] as $val): ?>
										<option name="__<?php echo $x; ?>__<?php echo $val['name']; ?>" value="<?php echo $val['name']; ?>"><?php echo ucwords($val['value']); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</section>
				

					<section class="col col-lg-6">
							<input type="text" class="form-control" name="__<?php echo $x; ?>__query"/>
					</section>
				
					<?php if ($x < 3) { ?>
						<section class="col col-lg-2">
							<div class="form-group">
								<select class="form-control"  name="__<?php echo $x; ?>__boolean">
									<option name="__<?php echo $x; ?>__and">AND</option>
									<option name="__<?php echo $x; ?>__or">OR</option>
									<option name="__<?php echo $x; ?>__not" value="and not">NOT</option>
								</select>
							</div>
						</section>
					<?php } else { ?>
						<button class="btn" type="submit">Go</button>
					<?php } ?>
					</main>
			<?php } ?>
			<input type="hidden" name="advanced_search" value="true"/>
			</article>



		
	</form>



	</div>

</div>