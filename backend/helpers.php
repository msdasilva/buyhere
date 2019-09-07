<?php /** * Retorna o diretório das views */ 

class UtilFactory {

    public static function viewsPath() { 
        return BASE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR; 
    } 
    /** * Converte datas entre os padrões ISO e brasileiro 
     * * Fonte: http://rberaldo.com.br/php-conversao-de-datas-formato-brasileiro-e-formato-iso/ 
     * */ 
    public static function dateConvert($date) { 
        if ( ! strstr( $date, '/' ) ) { 
            // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida 
            // para dd/mm/yyyy 
            sscanf($date, '%d-%d-%d', $y, $m, $d); 
            return sprintf('%02d/%02d/%04d', $d, $m, $y); 
        } else { 
            // $date está no formato brasileiro e deve ser convertida para ISO 
            sscanf($date, '%d/%d/%d', $d, $m, $y); 
            return sprintf('%04d-%02d-%02d', $y, $m, $d); 
        } 
        return false; 
    } 
    /** 
     * * Calcula a idade a partir da data de nascimento 
     * * * Sobre a classe DateTime: http://rberaldo.com.br/php-usando-a-classe-nativa-datetime/ 
     * */ 
    public static function calculateAge($birthdate) { 
        $now = new DateTime(); 
        $diff = $now->diff(new DateTime($birthdate));
        
        return $diff->y;
    }

    public static function debug($conteudo, $tipo) {
        echo "<pre>";
        print_r($conteudo);
        echo "</pre>";
        ($tipo) ? exit() : "<br />";
    }

}