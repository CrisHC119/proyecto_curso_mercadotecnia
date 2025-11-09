<style>
    .btn-tema_0 {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
        
    .btn-tema_1 {
        background: linear-gradient(135deg, #11cb11ff 0%, #25fc2cff 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(37, 252, 55, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
        
    .btn-tema_2 {
        background: linear-gradient(135deg, #cb1111ff 0%, #fc2525ff 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(252, 37, 37, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-tema_3 {
        background: linear-gradient(135deg, #11b8cbff 0%, #25dffcff 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(37, 238, 252, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-tema_4 {
        background: linear-gradient(135deg, #cb11a9ff 0%, #fc25f5ff 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(252, 37, 241, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
        
    .btn-tema_5 {
        background: linear-gradient(135deg, #202020ff 0%, #000000ff 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(5, 4, 5, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
       
    .btn-tema_5:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
    }
 
    .btn-tema_4:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(252, 37, 252, 0.6);
    }

    .btn-tema_3:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 252, 223, 0.6);
    }

    .btn-tema_2:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(252, 37, 37, 0.6);
    }

    .btn-tema_1:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 252, 123, 0.6);
    }

    .btn-tema_0:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 117, 252, 0.6);
    }
    
    .btn-tema_0:active,
    .btn-tema_1:active {
        transform: translateY(1px);
    }
    
    .btn-tema_0 i,
    .btn-tema_1 i {
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-tema_0:hover i,
    .btn-tema_1:hover i {
        transform: rotate(10deg);
    }
    
    .btn-tema_0::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        transition: all 0.3s ease;
    }
    
    .btn-tema_0:hover::after {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
    }
    @media (max-width: 768px) {

        .contenedor-cursos h2 {
            font-size: 1.0rem;
        }

        .contenedor-cursos h4 {
            font-size: 0.8rem;
        }

        .btn-tema_0,
        .btn-tema_1,
        .btn-tema_2,
        .btn-tema_3,
        .btn-tema_4,
        .btn-tema_5 {
            font-size: 0.5rem;
            padding: 12px 24px;
        }
    }
</style>