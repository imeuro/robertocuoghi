<form id="SearchCatalogo" class="search" method="get" action="/search-results/" role="search">

	<ul id="KeywordCatalogo" class="">
		<li class="col-md-12 left text-right"><a href="javascript:;" class="advancedsearch">Catalogue Search <span class="glyphicon glyphicon-menu-down"></span></a></li>
	</ul>



	<ul id="FiltersCatalogo">
		<li class="col-md-3 left"><h2>Search in Catalogue</h2></li>
		<li class="col-md-6 left">
			<input class="search-input" type="search" name="term" placeholder="Insert Keyword or Artwork Code...">
			<button class="search-submit-lens" type="submit" role="button"><span class="glyphicon glyphicon-search"></span></button>
		</li>
		<li class="col-md-3 left text-right"><a href="javascript:;" class="highlight">Close <span class="glyphicon glyphicon-menu-up"></span></a></li>

		<li class="col-md-12"></li>

		<li class="col-md-3 left"><h2>Filter results...</h2></li>
		<li class="col-md-6 left">
			<ul class="row">
				<li class="col-xs-12 select-contain">
					<?php
					$menu = wp_get_nav_menu_items('sidebar');
					//print_r($menu);
					echo '<select name="tipologia_opera" id="tipologia_opera" class="filter-select categoria">';
					echo '<option value="">By category <span class="glyphicon glyphicon-chevron-down"></span></option>';
					foreach ($menu as $menuitem) {
						$parent = '';
						if($menuitem->menu_item_parent!='0')
							$parent = '-';
						echo '<option class="level-0" value="'.$parent.$menuitem->object_id.'">'.$parent.' '.$menuitem->title.'</option>';
					}
					echo '</select>';
					?>

				</li>

				<li class="col-xs-12 select-contain">
					<select name="periodo" id="periodo" class="filter-select periodo">
						<option value="">By date <span class="glyphicon glyphicon-chevron-down"></span></option>
						<option class="level-0" value="1918-1929">1918 - 1929</option>
						<option class="level-0" value="1930-1939">1930 - 1939</option>
						<option class="level-0" value="1940-1949">1940 - 1949</option>
						<option class="level-0" value="1950-1959">1950 - 1959</option>
						<option class="level-0" value="1960-1969">1960 - 1969</option>
						<option class="level-0" value="1970-1979">1970 - 1979</option>
						<option class="level-0" value="1980-1986">1980 - 1986</option>
					</select>
				</li>

				<li class="col-xs-12 select-contain">
					<select name="museo" id="museo" class="filter-select museo">
						<option value="">By museum <span class="glyphicon glyphicon-chevron-down"></span></option>
						<?php
						$musei = get_terms( array(
						    'taxonomy' => 'museo',
						    'parent'   => 0
						) );
						foreach ($musei as $museo) {
							echo '<option class="level-0" value="'.$museo->term_id.'">'.$museo->name.'</option>';
						}
						?>
					</select>
				</li>
			</ul>

			<button class="search-submit" type="submit" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;SEARCH</button>
		</li>
		<li class="col-md-3 left text-right">&nbsp;</li>

	</ul>

</form>
