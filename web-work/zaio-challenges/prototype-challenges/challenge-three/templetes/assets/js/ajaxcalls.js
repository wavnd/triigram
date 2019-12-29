$(document).ready(() => {
    $.ajax({
        url: "/user",
        type: "GET",
        dataType: "json",
        success: (data) => {

            var unis = ['The University of Cape Town', 'Stellenbosch University', 'University of Pretoria', 'University of the Witwatersrand', 'University of Kwazulu Natal',
                'University of the Western Cape', 'Rhodes University', 'The University of South Africa', 'University of Johannesburg',
                'North West University', 'University of the Free State', 'Nelson Mandela Metropolitan University', 'Cape Peninsula University of Technology',
                'Durban University of Technology', 'University of Zululand', 'Monash University', 'Vaal University of Technology',
                'Central University of Technology', 'Walter Sisulu University', 'University of Limpopo', 'Tshwane University of Technology',
                'University of Fort Hare'];
            
            var courses = ['Commerce', 'Engineering & the Built Environment', 'Health Sciences', 'Humanities', 'Law', 'Science'];
            
            var countu = 0;
            console.log(data.university + " name");
            var one = 0;
            unis.forEach(i => {
                if (i == data.university) {
                    one = countu;
                } else {
                    countu++;
                } 
            });
            countu = 0;
            console.log(data.faculty + " name");
            var two = 0;
            courses.forEach(i => {
                if (i == data.faculty) {
                    two = countu;
                } else {
                    countu++;
                }
            });
            console.log("this is count "+two);
            

            $("#namei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>'+
                '<input id="name" type="text" name="name" class="form-control" value="'+data.name+'">');
            
            $("#surnamei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>'+
                '<input id="surname" type="text" name="surname" class="form-control" value="' + data.surname+'">');
            
            if(data.age === undefined){
                $("#agei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>' +
                    '<input id="age" type="number" name="age" class="form-control" value="0">');
            }else{
                $("#agei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>' +
                    '<input id="age" type="number" name="age" class="form-control" value="' + data.age + '">');
            }
            console.log('printing before box '+data.university+" "+data.faculty);
            
            $('#university').find('option:eq('+one+')').attr("selected", "selected");

            $('#faculty').find('option:eq(' + two + ')').attr("selected", "selected");

            if(data.fcourse == " "){
                $("#fcoursei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>' +
                    '<input id="fcourse" type="text" name="fcourse" placeholder="Favourite course" class="form-control">');
            }else{
                $("#fcoursei").html('<span class="input-group-text"><i class="fa fa-user"></i></span>' +
                    '<input id="fcourse" type="text" name="fcourse" placeholder="Favourite course" class="form-control" value="' + data.fcourse + '">');
            }
        
        }
    });
});

function getUni(name){

     
}