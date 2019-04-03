<template>
    <div>
        <table id="myTable" >
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{

            }
        },
        created(){
            this.datatable();
        },
        methods:{
            datatable(){
                $('#myTable').DataTable();
            }
        },
        mounted(){



        }
    }
</script>

