database name ==> 'travel-mm'
have 5 tables ==> about , users , posts , region , reports

about table ==> 
                id - int - 11 - primary
                description - text
                image1 - text
                image2 - text
                updated_at - timestamp - default current timestamp

users table ==>
                id - int - 11 - primary
                username - varchar(255)
                email - varchar(255)
                password - varchar(255)
                image - text
                role - int(11) - default role=0 - role1=admin and role0=user
                created_at - timestamp - default current timestamp

region table ==>
                id - int - 11 - primary
                name - varchar(255)
                created_at - timestamp - default current timestamp

reports table ==>
                id - int - 11 - primary
                username - varchar(255)
                title - varchar(255)
                description - text
                read_as - int(11) - default 0 , if 0 , not read and if 1, read
                created_at - timestamp - default current timestamp

posts table ==>
                id - int - 11 - primary
                title - varchar(255)
                user_id - int(11)
                region_id - int(11)
                city - varchar(100)
                description1 - text
                image1 - text
                description2 - text
                image2 - text
                created_at - timestamp - default current timestamp

home table ==>
                id - int(11) - primary
                image - text
                created_at -timestamp - default current timestamp                

                


