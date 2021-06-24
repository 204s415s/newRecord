<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                
                    
                    <div class="form-group row">
                        <label for="enter" class="col-sm-3 col-form-label">入学年月</label>
                        <input type="text" class="col-sm-9 form-control" id="enter" >
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">名前：</label>
                        <input type="text" class="col-sm-9 form-control" id="name" >
                    </div>
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">進捗：</label>
                        <input type="text" class="col-sm-9 form-control" id="progress">
                    </div>
                    <div class="form-group row">
                        <label for="question" class="col-sm-3 col-form-label">質問：</label>
                        <input type="textarea" class="col-sm-9 form-control" id="question">
                    </div>
                    <div class="form-group row">
                        <label for="aim" class="col-sm-3 col-form-label">目標：</label>
                        <input type="text" class="col-sm-9 form-control" id="aim">
                    </div>
                    <div class="form-group row">
                        <label for="nextdate" class="col-sm-3 col-form-label">次回面談予定：</label>
                        <input type="date" class="col-sm-9 form-control" id="nextdate">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
               
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data: function() {
            return {
                students: {},
                newCurriculum: {
                    student_id: '',
                    progress: '',
                    question: '',
                    aim: '',
                    nextdate: ''
                }
            }
        },
        
    }
</script>