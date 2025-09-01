<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\QuizSectionQuestionOption;
use App\Models\QuizSectionQuestion;
use App\Models\QuizSection;
use App\Models\Quiz;

class fakerFirstQuizAndSections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:faker-first-quiz-and-sections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description to create fake quizzes and sections';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Crear el cuestionario
        $quiz = new Quiz();
        $quiz->name = "NOM-035 Cuestionario";
        $quiz->description = "Evaluación de acontecimientos traumáticos severos y afectaciones";
        $quiz->save();

        // Sección I
        $section1 = new QuizSection();
        $section1->quizId = $quiz->id;
        $section1->name = "I.- Acontecimiento traumático severo";
        $section1->description = "Preguntas relacionadas con eventos traumáticos graves en el trabajo";
        $section1->save();

        $questions1 = [
            "¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?",
            "¿Asaltos?",
            "¿Actos violentos que derivaron en lesiones graves?",
            "¿Secuestro?",
            "¿Amenazas?",
            "¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?"
        ];

        foreach ($questions1 as $q) {
            self::createYesNoQuestion($section1->id, $q);
        }

        // Sección II
        $section2 = new QuizSection();
        $section2->quizId = $quiz->id;
        $section2->name = "II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes)";
        $section2->save();

        $questions2 = [
            "¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares?",
            "¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?"
        ];

        foreach ($questions2 as $q) {
            self::createYesNoQuestion($section2->id, $q);
        }

        // Sección III
        $section3 = new QuizSection();
        $section3->quizId = $quiz->id;
        $section3->name = "III.- Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (último mes)";
        $section3->save();

        $questions3 = [
            "¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?",
            "¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento?",
            "¿Ha tenido dificultad para recordar alguna parte importante del evento?",
            "¿Ha disminuido su interés en sus actividades cotidianas?",
            "¿Se ha sentido usted alejado o distante de los demás?",
            "¿Ha notado que tiene dificultad para expresar sus sentimientos?",
            "¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?"
        ];

        foreach ($questions3 as $q) {
            self::createYesNoQuestion($section3->id, $q);
        }

        // Sección IV
        $section4 = new QuizSection();
        $section4->quizId = $quiz->id;
        $section4->name = "IV.- Afectación (durante el último mes)";
        $section4->save();

        $questions4 = [
            "¿Ha tenido usted dificultades para dormir?",
            "¿Ha estado particularmente irritable o le han dado arranques de coraje?",
            "¿Ha tenido dificultad para concentrarse?",
            "¿Ha estado nervioso o constantemente en alerta?",
            "¿Se ha sobresaltado fácilmente por cualquier cosa?"
        ];

        foreach ($questions4 as $q) {
            self::createYesNoQuestion($section4->id, $q);
        }

        // Crear el quiz
        $quiz = new Quiz();
        $quiz->name = "GUÍA DE REFERENCIA 2";
        $quiz->description = "CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL EN LOS CENTROS DE TRABAJO";
        $quiz->save();

        // ============================
        // Sección 1: Condiciones de trabajo
        // ============================
        $section1 = new QuizSection();
        $section1->quizId = $quiz->id;
        $section1->name = "Condiciones de su centro de trabajo, cantidad y ritmo de trabajo";
        $section1->save();

        $questions1 = [
            "1 Mi trabajo me exige hacer mucho esfuerzo físico",
            "2 Me preocupa sufrir un accidente en mi trabajo",
            "3 Considero que las actividades que realizo son peligrosas",
            "4 Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno",
            "5 Por la cantidad de trabajo que tengo debo trabajar sin parar",
            "6 Considero que es necesario mantener un ritmo de trabajo acelerado",
            "7 Mi trabajo exige que esté muy concentrado",
            "8 Mi trabajo requiere que memorice mucha información",
            "9 Mi trabajo exige que atienda varios asuntos al mismo tiempo",
        ];
        foreach ($questions1 as $q) {
            self::createLikertQuestion($section1->id, $q);
        }

        // ============================
        // Sección 2: Responsabilidades
        // ============================
        $section2 = new QuizSection();
        $section2->quizId = $quiz->id;
        $section2->name = "Actividades y responsabilidades en el trabajo";
        $section2->save();

        $questions2 = [
            "10 En mi trabajo soy responsable de cosas de mucho valor",
            "11 Respondo ante mi jefe por los resultados de toda mi área de trabajo",
            "12 En mi trabajo me dan órdenes contradictorias",
            "13 Considero que en mi trabajo me piden hacer cosas innecesarias",
        ];
        foreach ($questions2 as $q) {
            self::createLikertQuestion($section2->id, $q);
        }

        // ============================
        // Sección 3: Tiempo y familia
        // ============================
        $section3 = new QuizSection();
        $section3->quizId = $quiz->id;
        $section3->name = "Tiempo de trabajo y responsabilidades familiares";
        $section3->save();

        $questions3 = [
            "14 Trabajo horas extras más de tres veces a la semana",
            "15 Mi trabajo me exige laborar en días de descanso, festivos o fines de semana",
            "16 Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales",
            "17 Pienso en las actividades familiares o personales cuando estoy en mi trabajo",
        ];
        foreach ($questions3 as $q) {
            self::createLikertQuestion($section3->id, $q);
        }

        // ============================
        // Sección 4: Decisiones en el trabajo
        // ============================
        $section4 = new QuizSection();
        $section4->quizId = $quiz->id;
        $section4->name = "Decisiones que puede tomar en su trabajo";
        $section4->save();

        $questions4 = [
            "18 Mi trabajo permite que desarrolle nuevas habilidades",
            "19 En mi trabajo puedo aspirar a un mejor puesto",
            "20 Durante mi jornada de trabajo puedo tomar pausas cuando las necesito",
            "21 Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo",
            "22 Puedo cambiar el orden de las actividades que realizo en mi trabajo",
        ];
        foreach ($questions4 as $q) {
            self::createLikertQuestion($section4->id, $q);
        }

        // ============================
        // Sección 5: Capacitación e información
        // ============================
        $section5 = new QuizSection();
        $section5->quizId = $quiz->id;
        $section5->name = "Capacitación e información que recibe";
        $section5->save();

        $questions5 = [
            "23 Me informan con claridad cuáles son mis funciones",
            "24 Me explican claramente los resultados que debo obtener en mi trabajo",
            "25 Me informan con quién puedo resolver problemas o asuntos de trabajo",
            "26 Me permiten asistir a capacitaciones relacionadas con mi trabajo",
            "27 Recibo capacitación útil para hacer mi trabajo",
        ];
        foreach ($questions5 as $q) {
            self::createLikertQuestion($section5->id, $q);
        }

        // ============================
        // Sección 6: Relaciones laborales
        // ============================
        $section6 = new QuizSection();
        $section6->quizId = $quiz->id;
        $section6->name = "Relaciones con compañeros y jefe";
        $section6->save();

        $questions6 = [
            "28 Mi jefe tiene en cuenta mis puntos de vista y opiniones",
            "29 Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo",
            "30 Puedo confiar en mis compañeros de trabajo",
            "31 Cuando tenemos que realizar trabajo de equipo los compañeros colaboran",
            "32 Mis compañeros de trabajo me ayudan cuando tengo dificultades",
            "33 En mi trabajo puedo expresarme libremente sin interrupciones",
            "34 Recibo críticas constantes a mi persona y/o trabajo",
            "35 Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones",
            "36 Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones",
            "37 Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador",
            "38 Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores",
            "39 Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo",
            "40 He presenciado actos de violencia en mi centro de trabajo",
        ];
        foreach ($questions6 as $q) {
            self::createLikertQuestion($section6->id, $q);
        }

        // ============================
        // Sección 7: Atención a clientes y usuarios
        // ============================
        $section7 = new QuizSection();
        $section7->quizId = $quiz->id;
        $section7->name = "Atención a clientes y usuarios";
        $section7->save();

        self::createYesNoQuestion($section7->id, "En mi trabajo debo brindar servicio a clientes o usuarios");

        $questions7 = [
            "41 Atiendo clientes o usuarios muy enojados",
            "42 Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas",
            "43 Para hacer mi trabajo debo demostrar sentimientos distintos a los míos",
        ];
        foreach ($questions7 as $q) {
            self::createLikertQuestion($section7->id, $q);
        }

        // ============================
        // Sección 8: Supervisión de trabajadores
        // ============================
        $section8 = new QuizSection();
        $section8->quizId = $quiz->id;
        $section8->name = "Soy jefe de otros trabajadores";
        $section8->save();

        self::createYesNoQuestion($section8->id, "¿Es usted jefe de otros trabajadores?");

        $questions8 = [
            "44 Comunican tarde los asuntos de trabajo",
            "45 Dificultan el logro de los resultados del trabajo",
            "46 Ignoran las sugerencias para mejorar su trabajo",
        ];
        foreach ($questions8 as $q) {
            self::createLikertQuestion($section8->id, $q);
        }

        $newQuiz = new Quiz();
        $newQuiz->name = "GUÍA DE REFERENCIA 3";
        $newQuiz->description = "CUESTIONARIO PARA IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUAR EL ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO";
        $newQuiz->save();

        // ---------------------- Sección 1 ----------------------
        $section1 = new QuizSection();
        $section1->quizId = $newQuiz->id;
        $section1->name = "Condiciones ambientales";
        $section1->save();

        self::createLikertQuestion($section1->id, "1 El espacio donde trabajo me permite realizar mis actividades de manera segura e higiénica");
        self::createLikertQuestion($section1->id, "2 Mi trabajo me exige hacer mucho esfuerzo físico");
        self::createLikertQuestion($section1->id, "3 Me preocupa sufrir un accidente en mi trabajo");
        self::createLikertQuestion($section1->id, "4 Considero que en mi trabajo se aplican las normas de seguridad y salud en el trabajo");
        self::createLikertQuestion($section1->id, "5 Considero que las actividades que realizo son peligrosas");

        // ---------------------- Sección 2 ----------------------
        $section2 = new QuizSection();
        $section2->quizId = $newQuiz->id;
        $section2->name = "Cantidad y ritmo de trabajo";
        $section2->save();

        self::createLikertQuestion($section2->id, "6 Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno");
        self::createLikertQuestion($section2->id, "7 Por la cantidad de trabajo que tengo debo trabajar sin parar");
        self::createLikertQuestion($section2->id, "8 Considero que es necesario mantener un ritmo de trabajo acelerado");

        // ---------------------- Sección 3 ----------------------
        $section3 = new QuizSection();
        $section3->quizId = $newQuiz->id;
        $section3->name = "Esfuerzo mental";
        $section3->save();

        self::createLikertQuestion($section3->id, "9 Mi trabajo exige que esté muy concentrado");
        self::createLikertQuestion($section3->id, "10 Mi trabajo requiere que memorice mucha información");
        self::createLikertQuestion($section3->id, "11 En mi trabajo tengo que tomar decisiones difíciles muy rápido");
        self::createLikertQuestion($section3->id, "12 Mi trabajo exige que atienda varios asuntos al mismo tiempo");

        // ---------------------- Sección 4 ----------------------
        $section4 = new QuizSection();
        $section4->quizId = $newQuiz->id;
        $section4->name = "Actividades y responsabilidades";
        $section4->save();

        self::createLikertQuestion($section4->id, "13 En mi trabajo soy responsable de cosas de mucho valor");
        self::createLikertQuestion($section4->id, "14 Respondo ante mi jefe por los resultados de toda mi área de trabajo");
        self::createLikertQuestion($section4->id, "15 En el trabajo me dan órdenes contradictorias");
        self::createLikertQuestion($section4->id, "16 Considero que en mi trabajo me piden hacer cosas innecesarias");

        // ---------------------- Sección 5 ----------------------
        $section5 = new QuizSection();
        $section5->quizId = $newQuiz->id;
        $section5->name = "Jornada laboral";
        $section5->save();

        self::createLikertQuestion($section5->id, "17 Trabajo horas extras más de tres veces a la semana");
        self::createLikertQuestion($section5->id, "18 Mi trabajo me exige laborar en días de descanso, festivos o fines de semana");
        self::createLikertQuestion($section5->id, "19 Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales");
        self::createLikertQuestion($section5->id, "20 Debo atender asuntos de trabajo cuando estoy en casa");
        self::createLikertQuestion($section5->id, "21 Pienso en las actividades familiares o personales cuando estoy en mi trabajo");
        self::createLikertQuestion($section5->id, "22 Pienso que mis responsabilidades familiares afectan mi trabajo");

        // ---------------------- Sección 6 ----------------------
        $section6 = new QuizSection();
        $section6->quizId = $newQuiz->id;
        $section6->name = "Decisiones en el trabajo";
        $section6->save();

        self::createLikertQuestion($section6->id, "23 Mi trabajo permite que desarrolle nuevas habilidades");
        self::createLikertQuestion($section6->id, "24 En mi trabajo puedo aspirar a un mejor puesto");
        self::createLikertQuestion($section6->id, "25 Durante mi jornada de trabajo puedo tomar pausas cuando las necesito");
        self::createLikertQuestion($section6->id, "26 Puedo decidir cuánto trabajo realizo durante la jornada laboral");
        self::createLikertQuestion($section6->id, "27 Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo");
        self::createLikertQuestion($section6->id, "28 Puedo cambiar el orden de las actividades que realizo en mi trabajo");

        // ---------------------- Sección 7 ----------------------
        $section7 = new QuizSection();
        $section7->quizId = $newQuiz->id;
        $section7->name = "Cambios en el trabajo";
        $section7->save();

        self::createLikertQuestion($section7->id, "29 Los cambios que se presentan en mi trabajo dificultan mi labor");
        self::createLikertQuestion($section7->id, "30 Cuando se presentan cambios en mi trabajo se tienen en cuenta mis ideas o aportaciones");

        // ---------------------- Sección 8 ----------------------
        $section8 = new QuizSection();
        $section8->quizId = $newQuiz->id;
        $section8->name = "Capacitación e información";
        $section8->save();

        self::createLikertQuestion($section8->id, "31 Me informan con claridad cuáles son mis funciones");
        self::createLikertQuestion($section8->id, "32 Me explican claramente los resultados que debo obtener en mi trabajo");
        self::createLikertQuestion($section8->id, "33 Me explican claramente los objetivos de mi trabajo");
        self::createLikertQuestion($section8->id, "34 Me informan con quién puedo resolver problemas o asuntos de trabajo");
        self::createLikertQuestion($section8->id, "35 Me permiten asistir a capacitaciones relacionadas con mi trabajo");
        self::createLikertQuestion($section8->id, "36 Recibo capacitación útil para hacer mi trabajo");

        // ---------------------- Sección 9 ----------------------
        $section9 = new QuizSection();
        $section9->quizId = $newQuiz->id;
        $section9->name = "Relación con jefes";
        $section9->save();

        self::createLikertQuestion($section9->id, "37 Mi jefe ayuda a organizar mejor el trabajo");
        self::createLikertQuestion($section9->id, "38 Mi jefe tiene en cuenta mis puntos de vista y opiniones");
        self::createLikertQuestion($section9->id, "39 Mi jefe me comunica a tiempo la información relacionada con el trabajo");
        self::createLikertQuestion($section9->id, "40 La orientación que me da mi jefe me ayuda a realizar mejor mi trabajo");
        self::createLikertQuestion($section9->id, "41 Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo");

        // ---------------------- Sección 10 ----------------------
        $section10 = new QuizSection();
        $section10->quizId = $newQuiz->id;
        $section10->name = "Relación con compañeros";
        $section10->save();

        self::createLikertQuestion($section10->id, "42 Puedo confiar en mis compañeros de trabajo");
        self::createLikertQuestion($section10->id, "43 Entre compañeros solucionamos los problemas de trabajo de forma respetuosa");
        self::createLikertQuestion($section10->id, "44 En mi trabajo me hacen sentir parte del grupo");
        self::createLikertQuestion($section10->id, "45 Cuando tenemos que realizar trabajo de equipo los compañeros colaboran");
        self::createLikertQuestion($section10->id, "46 Mis compañeros de trabajo me ayudan cuando tengo dificultades");

        // ---------------------- Sección 11 ----------------------
        $section11 = new QuizSection();
        $section11->quizId = $newQuiz->id;
        $section11->name = "Reconocimiento, pertenencia y estabilidad";
        $section11->save();

        self::createLikertQuestion($section11->id, "47 Me informan sobre lo que hago bien en mi trabajo");
        self::createLikertQuestion($section11->id, "48 La forma como evalúan mi trabajo en mi centro de trabajo me ayuda a mejorar mi desempeño");
        self::createLikertQuestion($section11->id, "49 En mi centro de trabajo me pagan a tiempo mi salario");
        self::createLikertQuestion($section11->id, "50 El pago que recibo es el que merezco por el trabajo que realizo");
        self::createLikertQuestion($section11->id, "51 Si obtengo los resultados esperados en mi trabajo me recompensan o reconocen");
        self::createLikertQuestion($section11->id, "52 Las personas que hacen bien el trabajo pueden crecer laboralmente");
        self::createLikertQuestion($section11->id, "53 Considero que mi trabajo es estable");
        self::createLikertQuestion($section11->id, "54 En mi trabajo existe continua rotación de personal");
        self::createLikertQuestion($section11->id, "55 Siento orgullo de laborar en este centro de trabajo");
        self::createLikertQuestion($section11->id, "56 Me siento comprometido con mi trabajo");

        // ---------------------- Sección 12 ----------------------
        $section12 = new QuizSection();
        $section12->quizId = $newQuiz->id;
        $section12->name = "Violencia laboral";
        $section12->save();

        self::createLikertQuestion($section12->id, "57 En mi trabajo puedo expresarme libremente sin interrupciones");
        self::createLikertQuestion($section12->id, "58 Recibo críticas constantes a mi persona y/o trabajo");
        self::createLikertQuestion($section12->id, "59 Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones");
        self::createLikertQuestion($section12->id, "60 Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones");
        self::createLikertQuestion($section12->id, "61 Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador");
        self::createLikertQuestion($section12->id, "62 Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores");
        self::createLikertQuestion($section12->id, "63 Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo");
        self::createLikertQuestion($section12->id, "64 He presenciado actos de violencia en mi centro de trabajo");

        // ---------------------- Sección 13 ----------------------
        $section13 = new QuizSection();
        $section13->quizId = $newQuiz->id;
        $section13->name = "Atención a clientes y usuarios";
        $section13->save();

        self::createYesNoQuestion($section13->id, "En mi trabajo debo brindar servicio a clientes o usuarios");

        self::createLikertQuestion($section13->id, "65 Atiendo clientes o usuarios muy enojados");
        self::createLikertQuestion($section13->id, "66 Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas");
        self::createLikertQuestion($section13->id, "67 Para hacer mi trabajo debo demostrar sentimientos distintos a los míos");
        self::createLikertQuestion($section13->id, "68 Mi trabajo me exige atender situaciones de violencia");

        // ---------------------- Sección 14 ----------------------
        $section14 = new QuizSection();
        $section14->quizId = $newQuiz->id;
        $section14->name = "Supervisión de otros trabajadores";
        $section14->save();

        self::createYesNoQuestion($section14->id, "Soy jefe de otros trabajadores");

        self::createLikertQuestion($section14->id, "69 Comunican tarde los asuntos de trabajo");
        self::createLikertQuestion($section14->id, "70 Dificultan el logro de los resultados del trabajo");
        self::createLikertQuestion($section14->id, "71 Cooperan poco cuando se necesita");
        self::createLikertQuestion($section14->id, "72 Ignoran las sugerencias para mejorar su trabajo");

    }

    public static function createQuestionWithOptions($sectionId, $text, $options, $type = "multiple") {
        $question = new QuizSectionQuestion();
        $question->quizSectionId = $sectionId;
        $question->type = $type;
        $question->name = $text;
        $question->save();

        foreach ($options as $opt) {
            $option = new QuizSectionQuestionOption();
            $option->quizSectionQuestionId = $question->id;
            $option->name = $opt;
            $option->save();
        }
        return $question;
    }

    public static function createYesNoQuestion($sectionId, $text) {
        return self::createQuestionWithOptions($sectionId, $text, ["Sí", "No"], "yesOrNot");
    }

    public static function createLikertQuestion($sectionId, $text) {
        $options = ["Siempre", "Casi siempre", "Algunas veces", "Casi nunca", "Nunca"];
        return self::createQuestionWithOptions($sectionId, $text, $options, "multiple");
    }
}
