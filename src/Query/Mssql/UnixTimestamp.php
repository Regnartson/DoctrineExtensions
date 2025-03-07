<?php

namespace DoctrineExtensions\Query\Mssql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * @author Teresa Waldl <teresa@waldl.org>
 */
class UnixTimestamp extends FunctionNode
{
    public $date;

    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf(
            'UNIX_TIMESTAMP(%s)',
            $this->date ? $sqlWalker->walkArithmeticPrimary($this->date) : ''
        );

        $sql = 'SELECT DATEDIFF(SECOND,\'1970-01-01\', ' . $sqlWalker->walkArithmeticPrimary($this->date) . ')';
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        if (!$parser->getLexer()->isNextToken(Lexer::T_CLOSE_PARENTHESIS)) {
            $this->date = $parser->ArithmeticPrimary();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
