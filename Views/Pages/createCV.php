<div class="container my-4">

    <h1 class="my-4 text-center text-uppercase fw-bold text-main-pink">Create CV</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-form rounded">

                <form method="post" class="p-5 mb-5" id="createCV_form">

                    <?php include 'Views/Components/CV_personal_info.php'; ?>
                    <?php include 'Views/Components/CV_education.php'; ?>
                    <?php include 'Views/Components/CV_work_experience.php'; ?>
                    <?php include 'Views/Components/CV_others.php'; ?>

                    <button type="submit" class="mt-2 btn btn-primary">Create CV</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/CV-management-website/Scripts/dynamic_item.js"></script>

<script src="/CV-management-website/Scripts/load_location.js"></script>

<!-- <script>
    document.addEventListener("DOMContentLoaded", () => {
        loadLocationData();
    });
</script> -->