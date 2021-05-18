<template>
     <div v-if="Modalshow" class="modal fade show" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" style="display: block; padding-right: 16px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Modalshow=false">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="confirmDelete" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-primary" @click="Modalshow=false">No</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props : ['show'],
    data()
    {
        return
        {
            let Modalshow=this.show;
        }
    },
    created()
    {

    },
    methods:
    {
        confirmDelete(){
            this.$emit('confirmDelete');
            this.Modalshow = false;
        }
    }
}
</script>