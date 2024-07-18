<?PHP
	include 'system/header.php';
	?>
<!doctype html>
<html lang="en" >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= SERVER_NAME; ?> | Homepage</title>
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?= Call::Style(); ?>images/favicon.ico" />
		<link rel="stylesheet" href="<?= Call::Style(); ?>css/libs.min.css">
		<link rel="stylesheet" href="<?= Call::Style(); ?>css/style.css?v=1.0.0">
	</head>
	<body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
		<div id="loading">
			<div class="loader simple-loader">
				<div class="loader-body"></div>
			</div>
		</div>
		<div>
			<div class="wrapper">
				<span class="uisheet screen-darken"></span>
				<div class="header">
					<div class="container">
						<nav class="nav navbar navbar-dark bg-dark navbar-expand-lg  top-1 rounded">
							<div class="container-fluid">
								<a class="navbar-brand mx-2" href="<?= Call::URL(); ?>">
									<h5 class="logo-title"><?= strtoupper(SERVER_NAME); ?></h5>
								</a>
								<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
								</button>
								<div class="collapse navbar-collapse" id="navbar-2">
									<ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
										<?php if(FORUM_URL!='') { ?>
										<li class="nav-item">
											<a class="nav-link me-5" aria-current="page" href="<?= FORUM_URL; ?>">
												<p class="mb-0">FORUM</p>
											</a>
										</li>
										<?php } if(DISCORD_URL!='') { ?>
										<li class="nav-item">
											<a class="nav-link me-5" aria-current="page" href="<?= DISCORD_URL; ?>">
												<p class="mb-0">DISCORD</p>
											</a>
										</li>
										<?php } ?>
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
										Download
										</button>
									</ul>
								</div>
							</div>
						</nav>
					</div>
					<div class="slider-content position-relative">
						<div class="main-img vh-100">
							<div class="container">
								<div class="banner-img">
									<img src="<?= Call::Style(); ?>images/logo.png">
								</div>
							</div>
						</div>
						<div class="slider-banner">
							<img src="<?= Call::Style(); ?>images/pages/11.png" class="img-fluid" alt="images">
						</div>
					</div>
				</div>
				<div class="body-class-1 container">
					<aside class="mobile-offcanvas bd-aside card iq-document-card sticky-xl-top text-muted align-self-start mb-5 mt-n5" id="left-side-bar">
							<h4 class="fw-bold">
								Top Players
							</h4><br>
							<ul class="list-unstyled mb-0">
								<?php
								if($server_offline!=1) { 
								$players_ranking = array();
								$players_ranking = TOP10::Players();
								$players_numbers = 0;
								foreach($players_ranking as $p) { $players_numbers++; ?>
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<?= $players_numbers.'.'.$p['name']; ?>
											<span class="badge bg-<?= TOP10::Color(TOP10::Empire($p['account_id'])); ?> rounded-pill"  data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?= TOP10::EmpireName(TOP10::Empire($p['account_id'])); ?>"><?= $p['level']; ?></span>
										</li>
									</ul>
								<?php } } else { ?>
								<li>
									<div class="alert alert-danger">
										<center>Server are offline!</center>
									</div>
								</li>
								<?php } ?>
							</ul>
					</aside>
					<div class="bd-cheatsheet container-fluid bg-trasprent mt-n5">
						<section id="components">
							<article id="accordion">
								<div class="card">
									<div class="card-header">
										<h4 class="fw-bold">
											Register
										</h4>
									</div>
									<div class="card-content">
										<br><br>
										<center>
											<form method="POST" style="width:90%">
												<?php if(isset($register_message)) print $register_message; ?>
												<br>
												<div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
													<input type="text" class="form-control" name="username" id="floatingInput" placeholder="-" <?= Register::Status(); ?>>
													<label for="floatingInput">Username</label>
												</div>
												<div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
													<input type="password" class="form-control" name="password" id="floatingInput" placeholder="-" <?= Register::Status(); ?>>
													<label for="floatingInput">Password</label>
												</div>
												<div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
													<input type="password" class="form-control" name="rpassword" id="floatingInput" placeholder="-" <?= Register::Status(); ?>>
													<label for="floatingInput">Repeat password</label>
												</div>
												<div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
													<input type="email" class="form-control" name="email" id="floatingInput" placeholder="-" <?= Register::Status(); ?>>
													<label for="floatingInput">Email</label>
												</div>
												<div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
													<input type="number" maxlength="7" class="form-control" name="delete" id="floatingInput" placeholder="-" <?= Register::Status(); ?>>
													<label for="floatingInput">Character delete code</label>
												</div>
												<?= Register::Button(); ?>
											</form>
										</center>
										<br><br>
									</div>
								</div>
								<div class="bd-heading sticky-xl-top align-self-start">
									<div class="card">
										<div class="card-header">
											<h4 class="fw-bold">
												Statistics
											</h4>
										</div>
										<div class="card-body">
											<ul class="list-unstyled mb-0">
												<?php if($server_offline!=1) { ?>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Online players:&nbsp;</a> <?= Statistics::Players_Online(5); ?></span>
													</div>
												</li>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Online players (24h):&nbsp;</a> <?= Statistics::Players_Online(1440); ?></span>
													</div>
												</li>
												<hr>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Total accounts:&nbsp;</a> <?= Statistics::Characters(); ?></span>
													</div>
												</li>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Total characters:&nbsp;</a> <?= Statistics::Accounts(); ?></span>
													</div>
												</li>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Total guilds players:&nbsp;</a> <?= Statistics::Guilds(); ?></span>
													</div>
												</li>
												<hr>
												<li>
													<div class="d-flex align-items-center mt-2">
														<svg width="20" class="me-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span><a href="">Offline Shops:&nbsp;</a> <?= Statistics::Shops(); ?></span>
													</div>
												</li>
												<?php } else { ?>
												<li>
													<div class="alert alert-danger">
														<center>Server are offline!</center>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
							</article>
						</section>
					</div>
				</div>
				<div id="back-to-top" style="display: none;">
					<a class="btn btn-primary btn-xs p-0 position-fixed top" id="top" href="#top">
						<svg width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M5 15.5L12 8.5L19 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</a>
				</div>
				<div class="middle" style="display: none;">
					<button data-trigger="left-side-bar" class="d-xl-none btn btn-xs mid-menu" type="button">
						<i class="icon">
							<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</i>
					</button>
				</div>
			</div>
		</div>
		<footer class="footer" style="margin-top:200px;">
			<div class="footer-body">
				<ul class="left-panel list-inline mb-0 p-0">
				</ul>
				<div class="right-panel">
					©<script>document.write(new Date().getFullYear())</script> <?= SERVER_NAME; ?>, Made with
					<span class="text-gray">
						<svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
						</svg>
					</span>
					by <a href="https://metin2.dev/profile/48222-mutulic/">Mutulic</a>.
				</div>
			</div>
		</footer>
		<div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Download</h5>
					</div>
					<div class="modal-body">
						<div class="card-content">
							<center>
								<?php
									$i=0;
									foreach($download as $name => $links)
									{
										$i++;
										if($links['link']!='')
										{
											if($i%3==1) print '<br><br>';
											print '<a type="button" href="'.$links['link'].'" class="btn btn-danger">';
											print '<svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2744 19.75V4.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M18.299 13.7002L12.275 19.7502L6.25 13.7002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>&nbsp;';
											print $name;
											print '</a>';
											if(count($download)>1) print '&nbsp&nbsp';
										}
									}
									?>
							</center>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<script src="<?= Call::Style(); ?>js/libs.min.js"></script>
		<script src="<?= Call::Style(); ?>js/fslightbox.js"></script>
		<script src="<?= Call::Style(); ?>js/app.js"></script>
		<script src="<?= Call::Style(); ?>js/prism.mini.js"></script>
	</body>
</html>