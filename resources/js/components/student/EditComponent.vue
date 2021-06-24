<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form>
                    <div class="form-group row">
                        <label for="id" class="col-sm-3 col-form-label">ID</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id" v-bind:value="studentId">
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <input type="text" class="col-sm-9 form-control" id="name">
                    </div>
                    <div class="form-group row">
                        <label for="class" class="col-sm-3 col-form-label">class</label>
                        <input type="text" class="col-sm-9 form-control" id="class">
                    </div>
                    <div class="form-group row">
                        <label for="grade" class="col-sm-3 col-form-label">Grade</label>
                        <input type="text" class="col-sm-9 form-control" id="grade">
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-sm-3 col-form-label">Experience</label>
                        <input type="text" class="col-sm-9 form-control" id="experience">
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <input type="text" class="col-sm-9 form-control" id="description">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        props: {
            studentId: String
        }
    }
</script>