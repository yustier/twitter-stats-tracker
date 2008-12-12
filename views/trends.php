	<?php $this->load->view('emb_header', array('page_title'=>$page_title))?>


	<div id="container">
	
	
		<h1><?=$page_title?></h1>

		<div id="nav">
			<ul>
				<li><a href="<?=site_url()?>/trends/lasthour">Last Hour &rArr;</a></li>
				<li><a href="<?=site_url()?>/trends/last12hours">Last 12 Hrs &rArr;</a></li>
				<li><a href="<?=site_url()?>/trends/today">Today &rArr;</a></li>
				<li><a href="<?=site_url()?>/trends/yesterday">Yesterday &rArr;</a></li>
				<li><a href="<?=site_url()?>/trends/lastsevendays">Last 7 days &rArr;</a></li>
				<li><a href="<?=site_url()?>/trends/lastmonth">Last month &rArr;</a></li>
				<!-- <li><a href="<?=site_url()?>/trends/index">All time &rArr;</a></li> -->
			</ul>
		</div>

		
		<?php if ($period_start && $period_duration): ?>
			<?php if ($period_interval == 'hour'): ?>
				<h2><?=date('F j, Y g:i a', strtotime($period_start));?> – <?=date('F j, Y g:i a T', strtotime("$period_start +$period_duration hours"));?></h2>
			<?php else: ?>
				<h2><?=date('l, F j, Y', strtotime($period_start));?> – <?=date('l, F j, Y T', strtotime("$period_start +$period_duration days"));?></h2>
			<?php endif ?>
		<?php endif ?>
		
	
		<div id="chart"><img src="<?php echo $chart_url?>" /></div>
		<!--  -->

		<div id="adsense">
			<script type="text/javascript"><!--
			google_ad_client = "pub-7378172068209306";
			/* Twitter Stats Topics 468x15, created 10/16/08 */
			google_ad_slot = "9098091585";
			google_ad_width = 468;
			google_ad_height = 15;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
			<script type="text/javascript"><!--
			// google_ad_client = "pub-7378172068209306";
			// /* Twitter Stats 468x60 */
			// google_ad_slot = "7756658761";
			// google_ad_width = 468;
			// google_ad_height = 60;
			//-->
			</script>
			<!-- <script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script> -->
		</div>

		<?php if (isset($terms) && is_array($terms) && count($terms)>0): ?>
			<div id="terms-links">
				<h3>Search Twitter for…</h3>
				<ul>
					<?php foreach ($terms as $value): ?>
						<li><a href="http://search.twitter.com/search?q=<?=urldecode($value)?>" target="_blank" title="Search for post containing &quot;<?=urldecode($value)?>&quot;"><?=urldecode($value)?></a></li>
					<?php endforeach ?>
				</ul>

			</div>			
		<?php endif ?>

		<div id="note">
		This data is derived from the Twitter Trends API method. Samples are taken every 5 minutes. Data collection began on 2008-09-23.<p />

		If you're looking for a desktop Twitter client, you might consider <a href="http://funkatron.com/spaz">Spaz</a>, an open-source Twitter client written in JavaScript for the AIR platform.<p />
		
		These stats are collected by a <a href="http://php.net/" title="PHP: Hypertext Preprocessor">PHP</a> script and stored in a <a href="http://incubator.apache.org/couchdb/" title="Apache CouchDB: The CouchDB Project">CouchDB</a> server. <a href="http://codeigniter.com">CodeIgniter</a>, a PHP framework, was used to create this web app. The chart is generated by the <a href="http://code.google.com/apis/chart/" title="Developer&#39;s Guide - Google Chart API - Google Code">Google Chart API</a>, and the sortable table is courtesy of <a href="http://jquery.com/" title="jQuery: The Write Less, Do More, JavaScript Library">jQuery</a> + <a href="http://tablesorter.com/" title="jQuery plugin: Tablesorter 2.0">tablesorter</a>.  Source code is available <a href="http://github.com/funkatron/twitter-stats-tracker/tree/master">on Github</a>.<p />
		
		Contact me on Twitter: <a href="http://twitter.com/funkatron">@funkatron</a><p />
		
		<?php if (isset($last_updated)): ?>
		<em><strong>Last updated:</strong> <?=date('l, F j, Y \a\t g:i:s a T', $last_updated)?></em><p />	
		<?php endif ?>
		
		
		</div>
		
		<div id="ad">
			Funkatron.com is hosted at <a href="http://vpslink.com/vps-hosting/?ref=F48BHZ" target="_blank">VPSLink.com</a>, and I like it a lot. They're pretty cheap, and quite reliable in my experience. If you sign up with them, I get a little money to help out with my own hosting costs. Thanks! 
		</div>


		<?php if (isset($source_counts) && is_array($source_counts) && sizeof($source_counts)>0): ?>
			<script type="text/javascript" charset="utf-8">
				$().ready( function() {
				
					$('input#compare').val(''); // blank this out to get rid of firefox "memory"
				
					$('A.compare-link').click( function(e) {
						e.stopPropagation();
						var id = e.target.id;
						var term = id.replace(/--term-/, '');
						if (term) {
							showCompare();
							addTerm(term);
						} 
					} );
				
					$('form#compare-form').bind('submit', function() {
						compare();
					});
					$('input#submit').bind('click', function() {
						compare();
					});
				} );
			
			
				function showCompare() {
					if ($('#comparisons:hidden').length>0) {
						$('#comparisons').fadeIn('500');
					}
				
				}
			
				function addTerm(term) {
					var current_terms = $('#compare').val();
					if (current_terms.length > 0) {
						$('#compare').val(current_terms+','+term);
					} else {
						$('#compare').val(term);
					}
				
				
				}
			
				function compare() {
					var terms = $('#compare').val();
					terms = $.trim(terms);
					document.location = '<?=site_url()?>/trends/last24hours/'+encodeURIComponent(terms)
				}
			
			
			</script>

			<div id="comparisons" style="display:none; text-align:center">
				<form id="compare-form">
					<label for="compare">Terms</label> <input type="text" name="compare" value="" id="compare" />
					<input type="button" name="submit" value="Compare" id="submit" />
				</form>
			
				<div id="compare-notes">Separate terms with commas</div>
			</div>


		
		
			<table id="full-list" class="tablesorter">
				<thead>
				<tr>
					<th>Term</th>
					<th>%</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
				<?foreach($source_counts as $key=>$val):?>
				<tr>
					<td>
						<a title="Search for post containing &quot;<?=$key?>&quot;" href="http://search.twitter.com/search?q=<?=urlencode($key)?>" target="_blank"><?=$key?></a>
					</td>
					<td><?=number_format(($val/$sources_total)*100, 3)?>%</td>
					<td>
						[<a title="Examine popularity of &quot;<?=$key?>&quot; over the last 12 hours" href="<?=site_url()?>/trends/last12hours/<?=$key?>">Chart last 12hrs</a>]
						[<a title="Examine popularity of &quot;<?=$key?>&quot; over the last 24 hours" href="<?=site_url()?>/trends/last24hours/<?=$key?>">Chart last 24hrs</a>]
						[<a title="Compare term popularity" id="--term-<?=$key?>" class="clickable compare-link">Compare…</a>]
					</td>
				</tr>
				<?endforeach;?>
				</tbody>
			</table>
		
		
		<?php endif ?>
		
		
	</div>

	<?php $this->load->view('emb_footer')?>