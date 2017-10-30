  	<!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
			<li><a href="index.php" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
		    <li><a href="new-admission.php"><i class="fa fa-tasks"></i> <span>New Admission</span></a></li>
			<li class="has_sub"><a href="#"><i class="fa fa-thumbs-up"></i> <span>Search Student</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
				<ul>
				  <li><a href="search.php">Search Admission</a></li>
				  <li><a href="search-phone.php">Search Phone</a></li>
				</ul>
			</li>
			<li class="has_sub"><a href="#"><i class="fa fa-table"></i> <span>Fee Details</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
				<ul>
				  <li><a href="add-concession.php">Add Concession</a></li>
				  <li><a href="make-payment.php">Make Payment</a></li>
				  <li><a href="get-fee-status.php">Get Fee Status</a></li>
				  <li><a href="check-rep.php">Check Receipt</a></li>
				</ul>
			</li> 
			<li><a href="set-fee.php"><i class="fa fa-bar-chart-o"></i> <span>Set Fees</span></a></li>
			<li><a href="add-branch.php"><i class="fa fa-edit"></i> <span>Add Branch</span></a></li>
			<li><a href="add-batch.php"><i class="fa fa-edit"></i> <span>Add Batch</span></a></li>
			<li><a href="add-academic.php"><i class="fa fa-edit"></i> <span>Add Academic Year</span></a></li>
			<li><a href="check-payment.php"><i class="fa fa-calendar"></i> <span>Check Payments</span></a></li>
			<li><a href="check-dues.php"><i class="fa fa-calendar"></i> <span>Check Dues</span></a></li>
        </ul>
    </div>
    <!-- Sidebar ends -->