CREATE DATABASE IF NOT EXISTS fotobuzondb DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE fotobuzondb;


CREATE USER foto6bzn IDENTIFIED BY 'fb2021DAW';
GRANT ALL PRIVILEGES ON fotobuzondb.* TO foto6bzn; 


-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2021 a las 07:40:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fotobuzondb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambios_estado`
--

CREATE TABLE `cambios_estado` (
  `id_cambio` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado_inicial` int(11) NOT NULL,
  `estado_final` int(11) NOT NULL,
  `fecha_cambio` datetime NOT NULL,
  `diasdesdepublicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cambios_estado`
--

INSERT INTO `cambios_estado` (`id_cambio`, `id_publicacion`, `id_categoria`, `estado_inicial`, `estado_final`, `fecha_cambio`, `diasdesdepublicacion`) VALUES
(28, 77, 2, 1, 2, '2021-11-17 14:02:18', 2),
(29, 77, 2, 2, 3, '2021-12-01 14:46:33', 16),
(30, 77, 2, 3, 4, '2021-12-06 14:49:11', 21),
(31, 128, 4, 1, 2, '2021-12-07 21:09:21', 6),
(32, 103, 3, 1, 2, '2021-12-07 21:09:36', 7),
(33, 100, 1, 1, 2, '2021-12-07 21:09:44', 12),
(34, 95, 2, 1, 2, '2021-12-07 21:09:53', 13),
(35, 85, 6, 1, 5, '2021-12-07 21:10:02', 14),
(36, 128, 4, 2, 3, '2021-12-08 13:29:53', 7),
(38, 190, 3, 1, 5, '2021-12-12 06:45:16', 0),
(39, 79, 3, 1, 5, '2021-12-12 06:52:11', 19),
(40, 100, 1, 2, 3, '2021-12-12 07:23:08', 16),
(41, 100, 1, 3, 4, '2021-12-12 07:23:31', 16),
(42, 90, 2, 1, 2, '2021-11-25 07:24:02', 2),
(43, 90, 2, 2, 3, '2021-11-29 07:24:10', 6),
(44, 90, 2, 3, 4, '2021-12-01 07:24:19', 8),
(45, 128, 4, 3, 4, '2021-12-12 07:29:18', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(180) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Zonas deportivas'),
(2, 'Parques y jardines'),
(3, 'Viales'),
(4, 'Mobiliario urbano'),
(5, 'Zonas infantiles'),
(6, 'Mascotas'),
(7, 'Robos / pérdidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `fecha_comentario` datetime NOT NULL,
  `comentario` longtext COLLATE utf8_spanish_ci NOT NULL,
  `autor_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_publicacion`, `fecha_comentario`, `comentario`, `autor_comentario`) VALUES
(49, 77, '2021-11-22 11:14:43', '   Hay cosas que me encienden mi racionalidad y no encuentro coherencia entre mis semejantes. Es una pena pero cada vez compruebo que este mundo no es el mío, me lo han cambiado tanto...    ', 5),
(50, 77, '2021-11-22 11:15:31', '   Luego echamos la culpa de todo a los pobres dueños de mascotas.    ', 10),
(51, 77, '2021-11-22 11:16:48', '   Se ve qué clase de personas son. Irresponsables como poco, estarán acostumbrados a que les limpien y a no dar explicaciones por sus comportamientos. Creo que es falta entre otras cosas de educación.    ', 7),
(52, 77, '2021-11-22 11:17:32', '   Quizás los padres sean ajenos a esto. Pero es vergonzoso el comportamiento.    ', 6),
(53, 81, '2021-11-22 12:13:22', '   A saber si es un dueño mayor o joven, si es alguien que vive solo o en compañía de las familia, si por estrés o cualquier otro problema puede haber tenido un lapsus, no juzguemos sin saber. A veces la vida no es fácil y los tiempos que corren tampoco.    ', 3),
(54, 81, '2021-11-22 12:14:22', '   Es posible que alguna persona mayor lo haya olvidado. Sí llamas al refugio o a la policía pueden mirar si tiene chip y ponerse en contacto con los dueños.    ', 9),
(55, 81, '2021-11-22 12:15:01', '   Pobrecito, está desatendido totalmente, necesita un buen baño y un corte de pelo. Qué lastimita , que carita de pena tiene.    ', 2),
(56, 81, '2021-11-22 12:15:53', '   Joo que pena, quizás como habéis dicho alguien mayor lo ha olvidado sin mala intención, ojalá sea así y se resuelva satisfactoriamente.    ', 4),
(57, 85, '2021-11-23 10:43:20', '   A saber si es un dueño mayor o joven, si es alguien que vive solo o en compañía de las familia, si por estrés o cualquier otro problema puede haber tenido un lapsus, no juzguemos sin saber. A veces la vida no es fácil y los tiempos que corren tampoco.    ', 2),
(58, 85, '2021-11-23 10:44:10', '   Es posible que alguna persona mayor lo haya olvidado. Sí llamas al refugio o a la policía pueden mirar si tiene chip y ponerse en contacto con los dueños.    ', 8),
(59, 85, '2021-11-23 10:45:28', '   Pobrecito, está desatendido totalmente, necesita un buen baño y un corte de pelo. Qué lastimita , qué carita de pena tiene.    ', 10),
(60, 85, '2021-11-23 10:46:24', '   Joo que pena, quizás como habéis dicho alguien mayor lo ha olvidado sin mala intención, ojalá sea así y se resuelva satisfactoriamente.    ', 3),
(61, 90, '2021-11-23 16:22:02', '   Nosotros pasamos hace poco por ahí y unos chicos tropezaron y casi se caen a la carretera cuando iban corriendo. Espero que lo arreglen pronto.    ', 13),
(62, 95, '2021-11-24 08:25:48', '   Luego nos quejamos de infraestructuras. Si hay carril bici antes que las bicis nos quejamos de derroche. Si hay muchas bicis y poco carril nos quejamos de falta de instalaciones. No justifico su mal estado.    ', 16),
(63, 95, '2021-11-24 08:26:41', '   Más allá del despilfarro que suponga o lo bueno o malo que sea el proyecto, ese dinero es de la Unión Europea (del EDUSI) y son proyectos de este tipo. Lo normal sería hacer un carril bici por donde pasa la gente, en Cánovas, Avenida de Alemania, etc, para que se pueda usar en el día a día.    ', 13),
(64, 95, '2021-11-24 08:28:16', '   La obra está en garantía todavía... se llama al contratista y a arreglarlo...    ', 5),
(65, 85, '2021-11-28 21:16:25', '   Pobrecito!    ', 5),
(73, 100, '2021-11-29 17:16:39', '   Hola, Javier. Las canastas han sido repuestas esta misma mañana. Un saludo.    ', 1),
(84, 100, '2021-11-29 17:30:29', '   Bien, ya era hora de que hicieran algo en las pistas.    ', 11),
(93, 128, '2021-12-03 13:27:44', '   Es lamentable cómo se trata el mobiliario. Esto lo pagamos entre todos, debemos tener más cuidado.    ', 7),
(94, 128, '2021-12-04 10:29:01', '   Esto no se puede consentir, no sé qué hace la gente para destrozar así las cosas.    ', 13),
(95, 128, '2021-12-09 13:30:39', '   En el día de hoy se ha ordenado la reparación de los bancos, que tendrá lugar en los próximos días.    ', 1),
(96, 190, '2021-12-12 06:38:42', '   Las escaleras están fatal, hay dos en medio de la calle, pero cabe decir que enfrente del colegio virgen de la montaña y al lado de la biblioteca hay dos calles accesibles sin escaleras. Espero que la señora se recupere a la mayor brevedad.    ', 13),
(98, 190, '2021-12-12 06:43:18', '   Este tipo de escaleras en el siglo XXI no deberían existir, hay que destruirlas y hacer rampa. Deseo no se haya hecho mucho daño y tenga una pronta recuperación.    ', 27),
(99, 79, '2021-12-12 06:52:37', '   No se contempla ninguna actuación por el momento.    ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `estado`) VALUES
(1, 'Registrado'),
(2, 'Aceptado'),
(3, 'Asignado'),
(4, 'Resuelto'),
(5, 'No procede resolución');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `tipo_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `size` double NOT NULL,
  `mimetype` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `path_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `tipo_imagen`, `id_objeto`, `size`, `mimetype`, `path_imagen`, `nombre_imagen`) VALUES
(14, 'publicacion', 77, 144944, 'image/jpeg', '/uploads/77/c098025af4.jpg', '257662425_4583232965088680_7356578715461652967_n.jpg'),
(15, 'publicacion', 77, 180553, 'image/jpeg', '/uploads/77/dfe0e0cdd1.jpg', '254997021_4784062378324578_1639508885296212097_n.jpg'),
(16, 'publicacion', 77, 226148, 'image/jpeg', '/uploads/77/b2003f6950.jpg', '254921100_4784062961657853_1665459555481892384_n.jpg'),
(17, 'publicacion', 77, 189422, 'image/jpeg', '/uploads/77/5e71e57356.jpg', '248523472_4784062774991205_6411779153014601764_n.jpg'),
(20, 'publicacion', 79, 112136, 'image/jpeg', '/uploads/79/bebf1c724b.jpg', '257861805_4412945572108300_7599929288247079014_n.jpg'),
(22, 'publicacion', 85, 102519, 'image/jpeg', '/uploads/85/bbd1f92160.jpg', '25955711366_n.jpg'),
(24, 'publicacion', 90, 173388, 'image/jpeg', '/uploads/90/e06758aafd.jpg', '252445240_4803353233032963_1118759865620941807_n.jpg'),
(25, 'publicacion', 90, 191615, 'image/jpeg', '/uploads/90/d7c3d40df6.jpg', '252207789_4803353393032947_2329794098406632763_n.jpg'),
(26, 'publicacion', 90, 142868, 'image/jpeg', '/uploads/90/2f58c227ba.jpg', '252782948_4803353076366312_809784255438181943_n.jpg'),
(27, 'publicacion', 95, 697226, 'image/jpeg', '/uploads/95/bf7350faf3.jpg', '248027632_4507801159268414_5252724588686478738_n.jpg'),
(28, 'publicacion', 100, 603068, 'image/jpeg', '/uploads/100/067c7e2206.jpg', '252903803_1513332585698359_3454857214226869808_n.jpg'),
(29, 'publicacion', 100, 692064, 'image/jpeg', '/uploads/100/44312c110b.jpg', '252755754_1513332699031681_1334588418784351714_n.jpg'),
(30, 'publicacion', 103, 634141, 'image/jpeg', '/uploads/103/b7ebec914d.jpg', '256881188_1699895760215685_4768101275407159498_n.jpg'),
(31, 'publicacion', 103, 599676, 'image/jpeg', '/uploads/103/9565822fe5.jpg', '257281841_1699895776882350_41617220163283303_n.jpg'),
(32, 'publicacion', 103, 467260, 'image/jpeg', '/uploads/103/37ab30d77e.jpg', '257967511_821_n.jpg'),
(36, 'publicacion', 128, 342971, 'image/jpeg', '/uploads/128/96e21e05c5.jpg', '256798029_4467910913316060_4228544121727834704_n.jpg'),
(37, 'publicacion', 128, 385618, 'image/jpeg', '/uploads/128/1197f6718b.jpg', '256800084_4467911259982692_8634092700414196835_n.jpg'),
(38, 'publicacion', 128, 336767, 'image/jpeg', '/uploads/128/9d11b921b8.jpg', '257248696_4467911039982714_2936538977757328357_n.jpg'),
(52, 'publicacion', 166, 805374, 'image/jpeg', '/uploads/166/a828f68e19.jpg', '265207028_10225023175223033_4083211118410441138_n.jpg'),
(53, 'publicacion', 166, 818081, 'image/jpeg', '/uploads/166/3bd34d65e0.jpg', '264476138_10225023172182957_7234617628874324881_n.jpg'),
(54, 'publicacion', 166, 161974, 'image/jpeg', '/uploads/166/c803e9bb2a.jpg', '266013237_10225023167302835_7398237134498182285_n.jpg'),
(69, 'publicacion', 190, 1090194, 'image/jpeg', '/uploads/190/b0c3b724f3.jpg', '2571989165997_n.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_prohibidas`
--

CREATE TABLE `palabras_prohibidas` (
  `id_palabra` int(11) NOT NULL,
  `nombre_palabra` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `palabras_prohibidas`
--

INSERT INTO `palabras_prohibidas` (`id_palabra`, `nombre_palabra`) VALUES
(1, 'tonto'),
(2, 'tontaina'),
(3, 'tonta'),
(4, 'tontino'),
(5, 'tontina'),
(6, 'tontito'),
(7, 'tontitas'),
(8, 'tontainas'),
(9, 'tonteo'),
(10, 'idiota'),
(11, 'idioto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_publicacion` int(11) NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_autor` int(11) NOT NULL,
  `localizacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `esta_creada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_publicacion`, `fecha_publicacion`, `titulo`, `descripcion`, `id_categoria`, `id_estado`, `id_autor`, `localizacion`, `esta_creada`) VALUES
(77, '2021-11-15 11:12:41', 'Restos de botellón en la Sierrilla', 'Este domingo paseando por los parques con los niños me encontré con restos de botellón en la zona de “recreo” en la Sierrilla que ya fue incendiada hace 2 años. Una pena que tratemos así nuestra ciudad.', 2, 4, 11, 'Parque de la Sierrilla', 1),
(79, '2021-11-22 11:52:35', 'Coches mal aparcados', 'En la plaza 8 de septiembre los coches no respetan la escasa acera existente. Deberían tener un poco de empatía, pues por ahí no pueden pasar cochecitos o sillas de ruedas, e incluso a duras penas pasa la gente a pie.', 3, 5, 6, 'Plaza 8 de septiembre', 1),
(85, '2021-11-23 10:42:01', 'Perro atado durante más de tres horas', 'Perro olvidado/abandonado en el Supermercados Extremadura de la Calle Camino Llano 34. Lleva el pobre ahí atado más de tres horas. ¿Alguien lo conoce?', 6, 5, 6, 'Camino Llano 999', 1),
(90, '2021-11-23 16:19:59', 'Valla rota en la ribera', 'El otro día paseando por la ribera vimos que la valla de madera que separa la calzada de la Ronda San Francisco está caída, y puede representar un peligro para las personas que pasen por ahí.', 2, 4, 15, 'Ronda San Francisco', 1),
(95, '2021-11-24 08:23:00', 'Mal estado del nuevo carril bici', 'Este es el estado en que se encuentra ya el carril bici del Parque del Príncipe recién terminado. El dineral gastado para dos bicicletas al día que pasan por allí, ¿a ustedes les parece este gasto necesario?', 2, 2, 17, 'Parque del Príncipe', 1),
(100, '2021-11-25 17:14:21', 'Canastas rotas en La Madrila', 'Hola! Estaría bien que arreglasen las canastas de las pistas deportivas de La Madrila, pues llevan así desde el verano y cada vez que vamos los amigos nos es imposible jugar a baloncesto. Gracias.', 1, 4, 7, 'La Madrila', 1),
(103, '2021-11-30 16:18:07', 'Baches en la calzada', 'Hace ya unas semanas que arreglaron la calle Sierpes, pero han dejado algunas zonas bastante mal, los vecinos seguimos a la espera de que terminen de reparar todas las zonas antes de que haya algún accidente.', 3, 2, 5, 'Calle Sierpes', 1),
(128, '2021-12-01 17:08:06', 'Bancos en mal estado', 'Varios bancos del paseo central del barrio de Cáceres el Viejo se encuentran en muy mal estado, debido a golpes de vehículos que aparcan junto a la multitienda que está próxima. Por favor, arreglen en cuanto sea posible.', 4, 4, 13, 'Cáceres el Viejo', 1),
(166, '2021-12-11 16:41:01', 'Arqueta sin rejilla en el parque', 'Llevo observando varios días la falta de protección de está arqueta en el paseo principal del Parque del Príncipe.\r\nPara evitar daños no deseados, ¿no sería posible o bien proceder a poner su reja o señalizar ya sea con cinta, con cono  o con otro medio su peligrosidad?\r\nEspero pronta resolución por el bien de los usuarios. Gracias a quien proceda.', 2, 1, 13, 'Parque del Príncipe', 1),
(190, '2021-12-12 06:37:50', 'Estaleras en mal estado', 'Esta mañana se ha caido una señora de 81 años con su muleta por las escaleras que estan enfrente de tambo de Alfonso IX, todas las mañanas tiene que bajar por ahí a por su pan y ni siquiera hay una rampa están pesosas y más para las personas mayores, a ver si a quien correspondan toman nota.', 3, 5, 33, 'Casas Baratas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `municipio` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(180) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `rol`, `nombre`, `apellidos`, `email`, `password`, `telefono`, `direccion`, `codigo_postal`, `municipio`, `provincia`) VALUES
(1, 'Admin', 'Admin', 'Ayuntamiento', 'admin@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '666999888', 'C/ de la Aventura 22', '10816', 'Guijo de Galisteo', 'Cáceres'),
(2, 'Usuario', 'Cristina', 'Domínguez Benito', 'cristina@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '666111222', 'Calle de la Higuerilla 99', '10001', 'Cáceres', 'Cáceres'),
(3, 'Usuario', 'Agustín', 'Zambrano García', 'agus@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '924300101', 'Avda. Extremadura 3, 1A', '06800', 'Mérida', 'Badajoz'),
(4, 'Admin', 'Paco', 'Morcillo García', 'paco@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Av. Cervantes 55', '10005', 'Cáceres', 'Cáceres'),
(5, 'Usuario', 'Pepe', 'Martínez', 'pepe@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '100020003', 'Calle Extremadura 22', '10195', 'Cáceres', 'Cáceres'),
(6, 'Usuario', 'Carlos', 'Romero', 'carlos@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Calle de la paz', '45663', 'Valladolid', 'Valladolid'),
(7, 'Usuario', 'Javier', 'Mostazo', 'javier@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Calle de la nube', '45663', 'Simancas', 'Valladolid'),
(8, 'Usuario', 'Fernando', 'Sánchez Galindo', 'fernando@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '555969696', 'Calle Virgen de los Antolines', '10816', 'Guijo de Galisteo', 'Cáceres'),
(9, 'Admin', 'David', 'Luengo', 'david@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '666000111', 'Calle Los Fresnos', '10004', 'Cáceres', 'Cáceres'),
(10, 'Usuario', 'Susana', 'Pérez Montes', 'susana@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Av. Extremadura 22', '10004', 'Cáceres', 'Cáceres'),
(11, 'Usuario', 'María', 'Gómez González', 'maria@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '456789123', 'Calle Paloma 33', '06800', 'Mérida', 'Badajoz'),
(12, 'Usuario', 'Alicia', 'Santos Benavides', 'alicia@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '987987987', 'Calle Gil Cordero 26', '10001', 'Cáceres', 'Cáceres'),
(13, 'Usuario', 'Ana', 'González Miranda', 'ana@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Avda. Portugal 22', '10001', 'Cáceres', 'Cáceres'),
(14, 'Usuario', 'Sandra', 'López Montero', 'sandra@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '456789456', 'Calle Badalona 24', '10005', 'Cáceres', 'Cáceres'),
(15, 'Usuario', 'Vanesa', 'Pérez Espada', 'vanesa@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '666999333', 'Calle de la Higuerilla 11', '10004', 'Cáceres', 'Cáceres'),
(16, 'Usuario', 'Santiago', 'Hernández Gil', 'santiago@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '963852741', 'Calle Hernando de Soto 22', '10002', 'Cáceres', 'Cáceres'),
(17, 'Usuario', 'Laura', 'Muriel Pérez', 'laura@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '486153000', 'Calle de la Bondad 43', '10002', 'Cáceres', 'Cáceres'),
(22, 'Usuario', 'Manuel', 'Romero Suárez', 'manuel@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '623447855', 'Calle Buenaventura 23', '06800', 'Mérida', 'Badajoz'),
(27, 'Usuario', 'Pedro', 'Gómez Magro', 'pedro@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '612612612', 'Calle Gil Cordero 21', '10001', 'Cáceres', 'Cáceres'),
(28, 'Usuario', 'Beatriz', 'Parra Santano', 'beatriz@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '987987987', 'Calle Buenavista 23', '06800', 'Mérida', 'Badajoz'),
(29, 'Usuario', 'Gonzalo', 'Gómez Magro', 'gonzalo@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '654987987', 'Calle Buenavista 23', '10001', 'Cáceres', 'Cáceres'),
(33, 'Usuario', 'Jose', 'Fernández Vázquez', 'jose@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '654654654', 'Calle Buenaventura 23', '10001', 'Cáceres', 'Cáceres'),
(34, 'Usuario', 'Pilar', 'Sánchez Pérez', 'pilar@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '927112233', 'Virgen de los Antolines 124', '10001', 'Cáceres', 'Cáceres');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambios_estado`
--
ALTER TABLE `cambios_estado`
  ADD PRIMARY KEY (`id_cambio`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  ADD PRIMARY KEY (`id_palabra`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `autor_publicacion` (`id_autor`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambios_estado`
--
ALTER TABLE `cambios_estado`
  MODIFY `id_cambio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `palabras_prohibidas`
--
ALTER TABLE `palabras_prohibidas`
  MODIFY `id_palabra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `publicaciones_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
